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
		return $_GET[$ke];
	}
}
	$sort = dg('sort', 'sort');
	$page = dg('page', 0);
	$sortType = dg('sortType', 'ASC');
	$pSize = dg('pageSize', 50);
	define("PAGE_SIZE", $pSize);

	$data = $model::find()->orderBy("$sort $sortType")->limit(PAGE_SIZE)->offset($page*PAGE_SIZE)->all();
?>
<div class="container">
<?php 
	$schema = (array) ($model::getTableSchema());
	$head = array_keys($schema['columns']);
	$head[] = "-";
?>
<a href="<?php echo $baseUrl?>/create" class="btn btn-primary">+</a>
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
</div>
<script>
	var baseUrl = '<?php echo $baseUrl?>';
</script>
<script src="/js/admin/panel/model.js"></script>