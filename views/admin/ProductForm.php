<?php
function dg($key, $def)
{
	if ( empty($_GET[$key]) )
	{
		return $def;
	}
	else
	{
		return $_GET[$ke];
	}
}
	$sort = dg('sort', 'id');
	$page = dg('page', 0);
	$sortType = dg('sortType', 'ASC');
	$pSize = dg('pageSize', 50);
	define("PAGE_SIZE", $pSize);

	if ( !is_array($data) )
	{
		$data = array();
	}
	// $data = app\models\Product::find()->orderBy("$sort $sortType")->limit(PAGE_SIZE)->offset($page*PAGE_SIZE)->all();
?>
<div class="container">
<?php 
	// $schema = (array) (app\models\Product::getTableSchema());
	$rules = (new app\models\Product)->rules();
	foreach ($rules as $rule) {
		if (!is_array($rule[0]))
		$head[] = $rule[0];
	}
	// $head = array_keys($schema['columns']);
?>
	<?php if (!empty($success)):?>
		<div class="alert alert-success">
			Товар добавлен/изменен id = <?php echo $success?>
		</div>
	<?php endif;?>
	
	<?php if (!empty($error)):?>
		<div class="alert alert-danger">
			Ошибка создания товара Поля: <?php echo implode(", ", array_keys($error))?> заполнены неверно
		</div>
	<?php endif;?>

	<h2>Картинка товара</h2>
	<form class="form-horizontal" action="/media/upload" target="uploadImage" method="post" enctype="multipart/form-data">
	    <div class="form-group">
			    <label class="col-sm-2 control-label">Картинка</label>
			    <div class="col-sm-6">
	    			<input type="file" class="form-control" name="image" id="fileToUpload">
				</div>
				<div class="col-sm-4">
					<img src="" id="previewImg">
				</div>
			</div>
	    <input type="submit" class="btn btn-small btn-primary col-sm-offset-2" value="Загрузить" name="submit">
	    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
	</form>
	<iframe name="uploadImage" onload="makeUploadImage()" style="display:none"></iframe>
	<hr>
	<h2>Данные товара</h2>
	<form method="POST" class="form-horizontal">
		<?php foreach ($head as $value) {
			if (!isset($data[$value]))
			{
				$data[$value] = '';
			}
			if (!empty($error) && in_array($value, array_keys($error)) )
			{
				$cClass = 'has-error';
			}
			else
			{
				$cClass = '';
			}
			?>
			<div class="form-group <?php echo $cClass?>">
			    <label class="col-sm-2 control-label" for="field-<?php echo $value?>"><?php echo $value?></label>
			    <div class="col-sm-10">
			    	<input type="text"  name="data[<?php echo $value?>]" value="<?php echo $data[$value]?>" class="form-control" id="field-<?php echo $value?>">
				</div>
			</div>
			<?php
		}?>
		<button type="submit" class="btn btn-default col-sm-offset-2">Create</button>
		<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
	</form>
	<BR>
</div>
<script>
	function makeUploadImage()
	{
		var iId = $(uploadImage)[0].window.document.body.innerHTML;
		if (iId.length > 4)
		{
			alert("Ошибка загрузки изображения");
		} 
		else
		{
			$("#field-image_id").val(iId);
			$('#previewImg').attr("src", "/media/image/"+iId+"/200x100.jpg");
		}
		
	}
</script>