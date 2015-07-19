<div class="container">
	<h1>Управление параметрами</h1>
	<p>
		<label>Включить смс информароваие о заказах <input type="checkbox" <?php if($data['smsEnable'] == 'Y') echo "checked" ?> onchange="smsParam(this.checked)" value="Y"></label>
	</p>
	<p>
		Номер для отправки смс <input type="tel" id="tel" value="<?php echo $data['noticePhone']?>"> <button onclick="telParam()" class='btn btn-sm'>Сохранить</button>
	</p>

	<p>
		Почта для отправки оповещеий <input type="email" id="email" value="<?php echo $data['newOrderNoticeEmail']?>"> <button onclick="saveParam('newOrderNoticeEmail', '#email', 'Email сохранен')" class='btn btn-sm'>Сохранить</button>
	</p>

    <p>
        <label>Доставка работает <input id="DISABLE_DELIVERY" type="checkbox" <?php if($data['DISABLE_DELIVERY'] != 'Y') echo "checked" ?> onchange="saveParam('DISABLE_DELIVERY', '#DISABLE_DELIVERY', 'Статус сохранен', this.checked ? 'N' : 'Y')" value="Y"></label>
    </p>
    <p>
        Причина простоя (необязательно) <input type="text" id="DISABLE_DELIVERY_REASON" value="<?php echo $data['DISABLE_DELIVERY_REASON']?>"> <button onclick="saveParam('DISABLE_DELIVERY_REASON', '#DISABLE_DELIVERY_REASON', 'текст сохранен')" class='btn btn-sm'>Сохранить</button>
    </p>

</div>

<script>
	
	function saveParam(pName, valId, success, value)
	{
        if (typeof value == "undefined")
        {
            var val = $(valId).val();
        } else {
            val = value;
        }
		$.get('/params/create', {'name':pName,'value':val}).success( function () {alert(success);} );
	}

	function telParam()
	{
		var tel = $('#tel').val();
		$.get('/params/create', {'name':'noticePhone','value':tel}).success( function () {alert("Номер изменен");} );
	}

	function smsParam(val)
	{
		if (val)
		{
			val = "Y";
		}
		else
		{
			val = "N";
		}
		$.get('/params/create?name=smsEnable&value='+val);
	}
</script>