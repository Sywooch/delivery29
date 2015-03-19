<?php

// $model = "app\models\DeliveryZone";

function dg($key, $def)
{
	if ( empty($_GET[$key]) )
	{
		return $def;
	}
	else
	{
		return $_GET[$key];
	}
}
	$sort = dg('sort', 'sort');
	$page = dg('page', 0);
	$sortType = dg('sortType', 'ASC');
	$pSize = dg('pageSize', 50);
	define("PAGE_SIZE", $pSize);
	$where = array();
	if (!empty($_GET['where']))
	{
		foreach ($_GET['where'] as $key => $value) {
			if (!empty($value) && $key != "-")
			$where[$key] = $value;
		}
	}
	$data = $model::find()->where($where)->orderBy("$sort $sortType")->limit(PAGE_SIZE)->offset($page*PAGE_SIZE)->all();
?>
<div class="container">
<?php 
	$schema = (array) ($model::getTableSchema());
	$head = array_keys($schema['columns']);
	$head[] = "-";
?>
<a href="<?php echo $baseUrl?>/create" class="btn btn-primary">+</a>
<h4 onclick="$('#filter').fadeIn()">Фильтр</h4><hr>
<form class="form-horizontal" style="display:none" id="filter">
	<?php foreach ($head as $columlName) :
		if ($columlName == '-') continue;
		$value = isset($where[$columlName]) ? $where[$columlName] : "";
		?>
		<div class="form-group">
	      <label for="filter-<?php echo $columlName?>" class="col-sm-2 control-label"><?php echo $columlName?></label>
	      <div class="col-sm-10">
	        <input type="text" name="where[<?php echo $columlName?>]" value="<?php echo $value?>" class="form-control" id="filter-<?php echo $columlName?>" placeholder="">
	      </div>
	    </div>
	<?php endforeach; ?>	
	<input type="submit" value="Фильтровать" class="btn btn-xs btn-primary">
	<input type="reset" value="Сбросить фильтр" class="btn btn-xs btn-danger">
</form>
<table class="table">
	<thead>
		<tr>
			<?php foreach ($head as $columlName) {
				echo "<th class='js-column-name'>$columlName</th>";
			}?>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($data as $product) {
		echo "<tr data-id='{$product->id}' id='item-{$product->id}'>";
		foreach ($head as $columlName) {
			if ($columlName != '-')
			{
				echo "<td  data-id='{$product->id}'  class='js-column-{$columlName}'>".$product->$columlName."</td>";
			}
			else
			{
				echo "<td class='js-edit' data-id='{$product->id}'></div>";
			}
		}
		echo "</tr>";		
	}?>
	</tbody>
</table>
<?php
	if ( count($data) >= PAGE_SIZE )
	{
		\Yii::$app->getRequest()->setQueryParams(['page'=>''.(dg('page', 0)+1)]);
		// die (\Yii::$app->getRequest()->getQueryParam('page'));
		$params = \Yii::$app->getRequest()->getQueryParams();
		// print_r($params);
		$url = \yii\helpers\Url::to(array_merge(["index"], $params));
		echo "<a href='$url'>Следующая страница =></a><br>";
	}
?>
</div>
<script>
	var baseUrl = '<?php echo $baseUrl?>';
</script>
<script src="/js/admin/panel/model.js"></script>