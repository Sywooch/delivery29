<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3" id="product-<?php echo $data->id?>" data-price="<?php echo $data->price?>" data-name="<?php echo $data->name?>">
	<div class="panel panel-default">
	  <div class="panel-body">
	    <p class="lead" style="font-size:11pt; height:43px;"><?php echo $data->name;?></p>
	  	<!--span class="label label-info price-text"><?php echo $data->price?> руб.</span>-->
	  	<img src="<?php echo $data->getImage(200,200);?>" class="fit-image" alt="<?php echo strip_tags($data->name)?>">
	  	<button class="btn btn-primary bold-text btn-wide btn-space-top" onclick="addToChart(<?php echo $data->id?>)">В корзину <?php echo $data->price?> руб.</button>
	  </div>
	</div>
</div>
