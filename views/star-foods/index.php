<?php
/* @var $this yii\web\View */
$this->title = 'Доставка еды домой и в офисы Архангельска';
?>
<div class="container">
	<div class="row">
		<div class="col-sm-7 col-md-8 col-lg-9">
		<div class="row">
		<?php 
			if (!empty($arProduct))
			{
				foreach ($arProduct as $subcategory) {
					echo $this->render('subcategory', ['subcategory'=>$subcategory]);
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
                    <h3>Доствка из Стар</h3>
                    <p>Доставка бургеров, роллов, хот-догов, снеков, соусов, салатов из ресторана Star Foods в Архангельске</p>
                </div>
            </div>
		</div>
		<div class="col-sm-5 col-md-4 col-lg-3">
			<div id="basket" style="">
				
			</div>
            <?php echo $this->render("../global/left-promo.php")?>
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
