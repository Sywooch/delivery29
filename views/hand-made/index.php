<?php
/* @var $this yii\web\View */
use app\models\HandMadeItem;

$this->title = "Украшения и аксессуары ручной работы";
?>
<div class="container">
    <?php foreach ($items as $item): ?>
        <?php
        /**
         * @var HandMadeItem $item
         */
        ?>
        <div class="col-sm-3 h-item js-item" data-price="<?= $item->price ?>">
            <a class="h-link" href="<?= $item->getUrl() ?>">
                <div class="h-price">
                    <?php if ($item->discount): ?>
                        <span class="old-price"><?= $item->getOldPriceFormatted(); ?></span>
                    <?php endif; ?>
                    <span class="price"><?= $item->getPriceFormatted(); ?></span>
                </div>
                <img class="thumbnail" alt="<?= $item->name ?>" src="<?= $item->getPreview(300, 300) ?>">
            </a>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="description">
                        <button class="js-buy btn-buy btn btn-primary">Купить</button>
                        <span class="name"><?= $item->name ?></span>
                        <p><?= $item->short_description ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>