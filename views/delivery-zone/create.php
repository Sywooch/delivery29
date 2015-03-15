<?php
$model = "app\\models\\DeliveryZone";
$baseUrl = "/deliveryzone";

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

	class Object {}

	if (!isset($data))
	{
		$data = new Object;
	}
	// $data = app\models\Product::find()->orderBy("$sort $sortType")->limit(PAGE_SIZE)->offset($page*PAGE_SIZE)->all();
?>
<div class="container">
<?php 
	// $schema = (array) (app\models\Product::getTableSchema());
	$rules = (new $model)->rules();
	$head = array();
	foreach ($rules as $rule) {
		if (!is_array($rule[0]))
		{
			$head[] = $rule[0];
		}
		else
		{	
			foreach ($rule[0] as $value) {
				if (!in_array($value, $head))
				{
					$head[] = $value;
				}
			}
		}
	}
	// $head = array_keys($schema['columns']);
?>
	<?php if (!empty($success)):?>
		<div class="alert alert-success">
			Элемент добавлен/изменен id = <?php echo $success?>
		</div>
	<?php endif;?>
	
	<?php if (!empty($error)):?>
		<div class="alert alert-danger">
			Ошибка создания элемента Поля: <?php echo implode(", ", array_keys($error))?> заполнены неверно
		</div>
	<?php endif;?>

	<h2><?php echo $model?></h2>
	<form method="POST" class="form-horizontal">
		<?php foreach ($head as $value) {
			if (!isset($data->$value))
			{
				$data->$value = '';
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
			    	<input type="text"  name="data[<?php echo $value?>]" value="<?php echo $data->$value?>" class="form-control" id="field-<?php echo $value?>">
				</div>
			</div>
			<?php
		}?>
		<button type="submit" class="btn btn-default col-sm-offset-2">Create</button>
		<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
	</form>
	<BR>
</div>