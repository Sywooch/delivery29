<?php
/* @var $this yii\web\View */
$this->title = 'Доставка Архагельск епта';
?>
<div class="container">
	<?php 
		foreach ($arProduct as $product) {
			echo $this->render('product', array('data'=>$product));
		}
	?>
</div>