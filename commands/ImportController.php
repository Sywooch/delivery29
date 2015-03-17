<?php
namespace app\commands;

use yii\console\Controller;
use app\models\Product;
use app\models\media;

/**
 * Import yaml file into db
 */
class ImportController extends Controller
{
	private $crateNewFile = false;
    /**
     * Inmport <file> <offeid>
     * @param boolean $offexid If item have not external id will it be create 
     */
    public function actionIndex($file = "import/db.yml", $offexid = false)
    {
    	$offexid = (bool) $offexid;
    	$failCounter = 0;
    	$successCounter = 0;
    	$badExId = array();
        echo "\nStart import from file = ".$file;
        if (!file_exists($file))
        {
        	echo "\nFile not found";
        	return;
        }
        try
        {
        	$data = yaml_parse_file($file);
        } catch (\Exception $e) {
        	echo "\nFail to parse file: ".$e->getMessage();
        	return;
        }
        foreach ($data['products'] as &$product) {
        	try
   			{
        		$this->saveProduct($product, $offexid);
   				$successCounter++;
   			}
   			catch (\Exception $e)
   			{
   				echo "\nFail to save product ".$e->getMessage();
   				print_r($product);
   				$failCounter++;
   				if (!empty($product['external_id']))
   				{
   					$badExId[] = $product['external_id'];
   				}
   			}
        }
        echo "\n===================";
        echo "\nImport end, success: $successCounter fail: $failCounter";
        if (!empty($badExId))
        {
        	echo "\nBad external id ".implode(", ", $badExId);
        }
        if ($this->crateNewFile)
        {
        	echo "\nCreating new {$file}_new.yml ...";
        	yaml_emit_file($file."_new.yml", $data);
        }
    }

    public function saveProduct(&$data, $offexid)
    {
    	if ($offexid || !empty($data['external_id']))
    	{
    		if (!empty($data['image']))
    		{	
	    		if (empty($data['external_id']))
	    		{
	    			$data['external_id'] = md5($data['name'].time().rand(0,100000));
	    			$this->crateNewFile = true;
	    		}
	    		$exId = $data['external_id'];
	    		$p = Product::find()->where(['external_id'=>$exId])->one();
	    		if (empty($p))
	    		{
	    			$p = new Product;
	    		}
	    		$data['image_id'] = $this->getMediaId( $data['image'] );
	    		$p->attributes = $data;
	    		if (!$p->save())
	    		{
	    			throw new \Exception(print_r($p->getErrors()), 1);
	    		}

    		}
    		else
    		{
    			throw new \Exception("Image is empty", 2);
    		}
    	}
    	else
    	{
    		throw new \Exception("External id is empty", 1);
    	}
    }

    function getMediaId( $url )
    {
    	if ($this->crateNewFile === false)
    	{
    		$this->crateNewFile = 0;
    	}
    	$ext = pathinfo($url, PATHINFO_EXTENSION);
    	if ( in_array(strtolower($ext), ['jpg', 'png']) )
    	{
    		$exId = "url_".md5($url);
    		$m = Media::find()->where(['external_id_hash'=>$exId])->one();
    		if (!empty($m) && $m->external_id_hash == $exId)
    		{
    			return $m->id;
    		}
	    	$data = file_get_contents($url);
	    	if (!empty($data))
	    	{
		    	$originFileName = Media::getNewOriginName('image', '_media', $ext);
				file_put_contents( Media::makePath( $originFileName ), $data );
				$media = new Media;
				$media->type = 'image';
				$media->file = $originFileName;
				$media->external_id_hash = $exId;
				$media->save();
				return $media->id;
	    	}
	    	else
	    	{
	    		throw new \Exception("Can't load image from $url", 1);
	    		
	    	}
    	}
    	else
    	{	
    		throw new \Exception("Bad image url (jpg png only) $url", 1);	
    	}
    }
}
