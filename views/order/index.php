<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1>Оформить заказ</h1>
        		<hr>
			<form id="order-from" onsubmit="makeOrder(); return false;" class="form-horizontal">
			  <div class="form-group" id="address">
			    <label for="address" class="col-sm-3 control-label">Адрес</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" name="address" placeholder="">
			    </div>
			  </div>
			  <div class="form-group" id="tel">
			    <label for="tel" class="col-sm-3 control-label">Телефон</label>
			    <div class="col-sm-9">
			      <input type="tel" name="tel" class="form-control" placeholder="+7(xxx) xxx xx xx">
			    </div>
			  </div>
			  <div class="form-group" id="comment">
			    <label for="comment" class="col-sm-3 control-label">Коментарий (необязательно)</label>
			    <div class="col-sm-9">
			      <textarea class="form-control" name="comment" placeholder="Ваш комментарий к заказу...."></textarea>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-3 col-sm-9">
			      <button type="submit" class="btn btn-primary">Оформить</button>
			      <label class="js-error-message text-danger"></label>
			      <label class="js-make-order-loader text-info" style="display:none">Пожалуйста подождите</label>
			      <label class="js-make-order-success text-success" style="display:none">Заказ успешно оформлен</label>
			    </div>
			  </div>
			</form>
			<div class="panel panel-default">
                                <div class='panel-body'>
                                        <h3 style="margin-top:0">Как оформить заказ?</h3>
                                        <ul>
                                                <li>
                                                        Введите ваш адрес и контактный телефон.
                                                </li>
                                                <li>Нажмите кнопку оформить</li>
                                                <li>Дождитесь звонка нашего оператора</li>
                                        </ul>
                                </div>
                        </div>
		</div>
		<div class="col-md-6">
			<div id="chart-data">
                                <p>Подождите корзина загружается....</p>
                        </div>
		</div>
	</div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
    	loadChart();
    	printChart('/mst/basket/order.mst', '#chart-data');
    	chart.defaultRewrite = function () {
	    	printChart('/mst/basket/order.mst', '#chart-data');
    	};
		$.fn.serializeObject = function()
		{
		    var o = {};
		    var a = this.serializeArray();
		    $.each(a, function() {
		        if (o[this.name] !== undefined) {
		            if (!o[this.name].push) {
		                o[this.name] = [o[this.name]];
		            }
		            o[this.name].push(this.value || '');
		        } else {
		            o[this.name] = this.value || '';
		        }
		    });
		    return o;
		};
	});

	function validate(key, value, all)
	{
		switch (key)
		{
			case "tel":
				if (typeof(value) != "string" || value.length < 9)
				{
					$('#tel').addClass('has-error');
					return false;
				}
			break;

			case "address":
				if (typeof(value) != "string" || value.length < 5)
				{
					$('#address').addClass('has-error');
					return false;
				}
			break;
		}
		return true;
	}

	function makeOrder()
	{
		try
		{
			$('.js-error-message').text("");
			$('.has-error').removeClass("has-error");
			var data = $('#order-from').serializeObject();
			data.zone_id = $('#delivery-zone').val();
			for (var x in data)
			{
				if (!validate(x, data[x], data))
				{
					$('.js-error-message').text("Пожалуйста запоните обязательные поля");
					return false;
				}
			}
			data.items = chart.items;
			$('.js-make-order-loader').fadeIn(200);
			postOrder(data);
		} catch (e) {
			alert("Упс, при оформлении заказа произошла ошибка, попробуйте позже");
			console.log(e);
		}
	}

	function postOrder(data)
	{
		$.post("/order/make", {"data":data}, function (data) {
			chart.removeAll();
			$('.js-make-order-success').fadeIn(200);
			window.location = "/order/success?id="+data.response;

		}, "json").fail(function() {
		    alert( "При оформлении заказа возникла проблема, попробуйте позже" );
		  })
		  .always(function() {
		    $('.js-make-order-loader').fadeOut(200);
		});
	}
</script>
