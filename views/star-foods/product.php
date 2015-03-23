<div
    class="col-sm-6 col-xs-12 col-md-4 col-sl-3"
    id="product-<?php echo $data->id?>"
    data-price="<?php echo $data->price?>"
    data-name="<?php echo $data->name?>"
    data-category_id="<?php echo $data->category_id?>">
  	<div class="star-foods-product btn-space-top" 
  		onclick="addToChart(<?php echo $data->id?>)">
  			<div class="price"><?php echo $data->price?> руб.</div> <?php echo $data->name?>
  	</div>
</div>
