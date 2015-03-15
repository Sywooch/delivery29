<?php
/* @var $this yii\web\View */
$this->title = 'Доставка Архагельск';
?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
		<?php 
			if (!empty($arProduct))
			{
				foreach ($arProduct as $product) {
					echo $this->render('../catalog/product', array('data'=>$product));
				}
			}
			else
			{
				echo $this->render('../catalog/no-items');
			}
		?>
		</div>
		<div class="col-md-3">
			<div id="basket">
				
			</div>
		</div>
	</div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
    	loadChart();
    	rewriteChart();
    	chart.defaultRewrite = function () { rewriteChart(); }
	});
</script>