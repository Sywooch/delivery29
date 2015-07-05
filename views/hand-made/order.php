<?php
/* @var $this yii\web\View */
use app\models\Order;
use app\models\OrderData;

/**
 * @var Order $order
 */
$this->title = "Заказ №".$order->id;
?>
<div class="container">
    <h1>Ваш заказ №<?=$order->id?> успешно создан</h1>
    <div class="col-sm-6">
        <p>Скоро вам на номер <?=$order->tel?> позвонит наш оператор чтобы уточнить дату и время доставки</p>
        <p><a href="<?php echo \Yii::$app->urlManager->createUrl(['static-page/index','page'=>'work']);?>">Режим работы службы доставки</a></p>
        <p>Телефон службы поддержки: <?=\Yii::$app->params['SUPPORT_PHONE']?></p>
    </div>
    <div class="col-sm-6">
        <p>Вы заказали следующие товары:</p>
        <div class="item-preview-list">
            <?php foreach($order->items as $item):?>
                <?php
                /**
                 * @var OrderData $item
                 */
                ?>
                <a href="<?=$item->product->getUrl()?>" style="display: block">
                    <img src="<?=$item->product->getPreview(150,150)?>" class="thumbnail">
                    <span><?=$item->product->name?></span>
                </a>
            <?php endforeach;?>
        </div>
        <p>Сумма вышего заказа: <?=$order->calcTotal()?>&nbsp;руб.</p>
    </div>
</div>