<?php
/* @var $this yii\web\View */
$this->title = 'Доставка еды домой и в офисы Архангельска';
?>
<div class="container">
	<div class="row">
		<div class="col-sm-7 col-md-8 col-lg-9">
		<div class="row" style="text-align: center">
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
            <div class="row">
                <div class='col-md-6'>
                    <h3>Доствка из Мак</h3>
                    <p>Доставим гамбургеры, ролы, картошку и многое другое из ресторана Макдоналд в архангельске</p>
                </div>
            </div>
		</div>
		<div class="col-sm-5 col-md-4 col-lg-3">
			<div id="basket" style="">
				
			</div>
		</div>
	</div>
	<div class="row">

	</div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    	loadChart();
    	rewriteChart();
    	chart.defaultRewrite = function () { rewriteChart(); }
	});
</script>
<script src="<?php echo \Yii::$app->urlManager->createUrl(['/js/on-click-mc.js'])?>"></script>
<div id="desktop-to-basket" class="desktop-to-basket" style="display: none">
    <div class="visible-md visible-lg">
        <a href="#basket" class="btn btn-success btn-wide">Перейти в корзину</a>
    </div>
</div>