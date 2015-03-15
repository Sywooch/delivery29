<div class="col-md-3" id="product-<?php echo $data->id?>" data-price="<?php echo $data->price?>" data-name="<?php echo $data->name?>">
	<div class="panel panel-default">
	  <div class="panel-body">
	    <p class="lead"><?php echo $data->name;?></p>
	  	<span class="label label-info price-text"><?php echo $data->price?> руб.</span>
	  	<img src="<?php echo $data->getImage(200,200);?>" class="fit-image">
	  	<button class="btn btn-primary bold-text btn-wide btn-space-top" onclick="addToChart(<?php echo $data->id?>)">В корзину</button>
	  </div>
	</div>
</div>