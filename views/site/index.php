<?php
/* @var $this yii\web\View */
$this->title = 'Доставка еды домой и в офисы Архангельска';
?>
<div class="yellowBlock subHeader">
	<div class="container">
		<div class="col-md-12">
			<h1>Доставка еды из <img class="hidden-sm hidden-xs" src="http://mcdonalds.ru/img/lm_logo.jpg" alt="Доставка 29"> Макдоналдс домой или в офис ежедневнно с 11 до 23</h1>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-7 col-md-8 col-lg-9">
		<div class="row">
		<?php 
			if (!empty($arProduct))
			{
				foreach ($arProduct as $product) {
					echo $this->render('../catalog/product', array('data'=>$product));
				}
			}
			else
			{
				echo $this->render('../catalog/no-items');
			}
		?>
		</div>
		<div class="row">
		<div class='col-xs-6'>
		<p>
			Заказывать еду в служебные помещения особенно удобно для людей с коротким перерывом и отдаленным местонахождением офиса. 
		</p>
		<p>
			Выбирая доставку еды от компании «Dostavka29», Вы можете быть полностью уверены в том, что предпочитаемая еда окажется на Вашем столе в необходимое время. 
		</p>
		<p>
			Выбранные блюда обязательно произведут хорошее впечатление и доставят немалое удовольствие своим высочайшим качеством и, соответственно, незабываемым вкусом. Поэтому услуга еда на заказ – это выбор современного, экономящего время и деньги человека.
		<p>
			 Доставка еды по городу Арханегльск не представляет для сотрудников нашей компании больших трудностей, так как все маршруты прорабатываются нами заранее. Таким образом, не смотря на сложные дорожные ситуации на улицах Архангельска, еда на заказ от нашей компании всегда доставляется точно в срок.
		</p>
		</div>
		<div class="col-xs-6">
			<p> Заказ еды на дом – это удобный и быстрый способ как накормить всю семью, так и полакомиться в одиночестве бесподобно вкусными блюдами из лучших ресторанов. Бесподобная еда с доставкой на дом от компании «Dostavka29» решит многие непредвиденные проблемы, связанные с приготовлением еды. Неожиданно приехавшие гости, внезапно появившийся повод для празднования, да и просто экономия большого количества времени любой хозяйки – это только некоторые из причин для заказа еды на дом. Стоит отметить, что еда с доставкой на дом в Архангельске превратит самое маленькое застолье в настоящее торжество. В зависимости от самых взыскательных предпочтений Вы с легкостью выберите любую еду с доставкой на дом, так как широчайший ассортимент кулинарии народов мира предлагает огромный выбор блюд на любой вкус и предпочтение.
			</p>
		</div>
		</div>
		</div>
		<div class="col-sm-5 col-md-4 col-lg-3">
			<div id="basket" style="">
				
			</div>
		</div>
	</div>
	<div class="row">

	</div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
    	loadChart();
    	rewriteChart();
    	chart.defaultRewrite = function () { rewriteChart(); }
	});
</script>