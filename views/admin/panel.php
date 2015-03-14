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

	$data = app\models\Product::find()->orderBy("$sort $sortType")->limit(PAGE_SIZE)->offset($page*PAGE_SIZE)->all();
?>
<div class="container">
<?php 
	$schema = (array) (app\models\Product::getTableSchema());
	$head = array_keys($schema['columns']);
	$head[] = "-";
?>
<a href="/admin/create" class='btn btn-success'>+</a>
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
		echo "<tr id='product-{$product->id}'>";
		foreach ($head as $columlName) {
			if ($columlName != '-')
			{
				echo "<td class=''>".$product->$columlName."</td>";
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
<script src="/js/admin/panel/product.js"></script>