<?php
/* @var $this yii\web\View */
$this->title = 'Доставка Архагельск';
?>
<div class="container">
	<div class="row">
		<div class="col-sm-7 col-md-8 col-lg-9">
		<div class="row">
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
		</div>
		<div class="col-sm-5 col-md-4 col-lg-3">
			<div id="basket" style="position:fixed; margin-right:20px">
				
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
