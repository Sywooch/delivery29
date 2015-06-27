<?php
/* @var $this yii\web\View */
use app\models\HandMadeItem;
use app\models\Media;

/**
 * @var HandMadeItem $item
 */
$this->title = $item->name;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <a href="<?= \yii\helpers\Url::to('/hand-made') ?>" class="btn-back btn btn-default">
                <span class="glyphicon glyphicon-chevron-left"></span> Обратно в каталог
            </a>
        </div>
    </div>
    <div class="row full-view-item">
        <div class="col-sm-6">
            <img class="thumbnail" src="<?= $item->getPreview(600, 600) ?>" alt="<?= $item->name ?>">
        </div>
        <div class="col-sm-6">
            <h1><?= $item->name ?></h1>
            <?php if ($item->discount): ?>
                <span class="old-price"><?= $item->getOldPriceFormatted() ?></span>
            <?php endif; ?>
            <span class="price"><?= $item->getPriceFormatted() ?></span>
            <button class="btn btn-primary btn-buy">Купить</button>
            <p class="description"><?= $item->getDescription() ?></p>

            <div class="gallery js-gallery">
                <?php foreach ($item->images as $image): ?>
                    <?php
                    /**
                     * @var Media $image
                     */
                    ?>
                    <a href="<?= $image->getUrl(1200, 1000) ?>">
                        <img class="thumbnail" src="<?=$image->getUrl(150,150)?>">
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>