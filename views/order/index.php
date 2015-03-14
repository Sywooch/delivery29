<div class="container">
	<h1>Оформить заказ</h1>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<div id="chart-data">
				<p>Подождите корзина загружается....</p>
			</div>
			<form class="form-horizontal">
			  <div class="form-group">
			    <label for="address" class="col-sm-3 control-label">Зона доставки</label>
			    <div class="col-sm-9">
			    	<?php foreach( $deliveryZones as $zone ):?>
			    		<label>
			    			<input onclick="setDeliveryPrice(<?php echo $zone->delivery_price?>); printChart('/mst/basket/order.mst', '#chart-data');" type="radio" name="deliveryZone" value="<?php echo $zone->id?>">
			    			<?php echo $zone->name;?>
			    		</label>
			    	<?php endforeach;?>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="address" class="col-sm-3 control-label">Адрес</label>
			    <div class="col-sm-9">
			      <input type="text" name="address" class="form-control" id="address" placeholder="">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="tel" class="col-sm-3 control-label">Телефон</label>
			    <div class="col-sm-9">
			      <input type="tel" class="form-control" id="tel" placeholder="+7(xxx) xxx xx xx">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="comment" class="col-sm-3 control-label">Коментарии</label>
			    <div class="col-sm-9">
			      <textarea class="form-control" id="comment" placeholder="Ваш комментарий к заказу...."></textarea>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-3 col-sm-9">
			      <button type="submit" class="btn btn-primary">Оформить</button>
			    </div>
			  </div>
			</form>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<p>
					Вопрос, что мы будем тут зармещать, варианта два:
				</p>
				<ul>
					<li>Карту с зонами дотсавки, по идее - это потому что можно сразу адрес точкой на карте показать и стоимость доставки вывести</li>
					<li>Инстуркции по закзазу, вермя доставик и всякие такие штуки</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
    	loadChart();
    	printChart('/mst/basket/order.mst', '#chart-data');
	});
</script>