<?php
/* @var $this yii\web\View */
$this->title = 'Доставка Архагельск епта';
?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
		<?php 
			foreach ($arProduct as $product) {
				echo $this->render('product', array('data'=>$product));
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
	});
</script>