<?php
/* @var $this yii\web\View */
$this->title = 'Что пишут';
?>
<div class="container">
	<h1>Hello world</h1>
	<?php 
		foreach ($arProduct as $product) {
			echo $this->render('product', array('data'=>$product));
		}
	?>
</div>