<?php
/* @var $this yii\web\View */
use app\models\HandMadeItem;
use yii\helpers\Url;

$this->title = "Украшения и аксессуары ручной работы";
?>
<div class="container">
    <?php foreach ($items as $item): ?>
        <?php
        /**
         * @var HandMadeItem $item
         */
        ?>
        <div class="col-sm-3 h-item js-hand-made-item" data-id="<?=$item->id?>" data-price="<?= $item->price ?>">
            <a class="h-link" href="<?= $item->getUrl() ?>">
                <div class="h-price">
                    <?php if ($item->discount): ?>
                        <span class="old-price"><?= $item->getOldPriceFormatted(); ?></span>
                    <?php endif; ?>
                    <span class="price js-price"><?= $item->getPriceFormatted(); ?></span>
                </div>
                <img class="thumbnail js-image" alt="<?= $item->name ?>" src="<?= $item->getPreview(300, 300) ?>">
            </a>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="description">
                        <button class="js-buy btn-buy btn btn-primary">Купить</button>
                        <span class="name js-name"><?= $item->name ?></span>
                        <?php if ($item->active != 1):?>
                            <span class="text-danger">Товар недоступен</span>
                        <?php endif;?>
                        <?php if (\Yii::$app->user->isGuest == false):?>
                            <a href="<?=\Yii::$app->urlManager->createUrl(['hand-made/edit', 'id'=>$item->id])?>">Редактировать</a>
                        <?php endif;?>
                        <p><?= $item->short_description ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>