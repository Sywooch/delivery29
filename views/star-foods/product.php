<div class="col-sm-6 col-xs-6 col-md-4 col-sl-3" id="product-<?php echo $data->id?>" data-price="<?php echo $data->price?>" data-name="<?php echo $data->name?>">
  	<div class="star-foods-product btn-space-top" 
  		onclick="addToChart(<?php echo $data->id?>)">
  			<?php echo $data->name?> <div class="price"><?php echo $data->price?> руб.</div>
  	</div>
</div>
