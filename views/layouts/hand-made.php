<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="<?php echo \Yii::$app->urlManager->createUrl('/css/style.hand-made.css?v1'). \app\assets\ConfigHelper::getVer()?>" rel="stylesheet">
    <meta name="title" content="Доставка 29 | Ювелирные укражения ручной работы">
    <meta name="description" content="<?php echo \app\assets\ConfigHelper::getDescription()?>">
    <meta name="keywords" content="<?php echo \app\assets\ConfigHelper::getKeywords()?>">
    <link rel="image_src" href="<?php echo \Yii::$app->urlManager->createUrl(['/img/logo.png']); ?>" />
</head>
<body>
<?php $this->beginBody() ?>
    <?php if (!\Yii::$app->user->isGuest): ?>
        <div>
        <a class="btn btn-xs btn-default" href="<?=Url::to(['/hand-made/edit', "new"=>true])?>">
            Добавить товар
        </a>
        </div>
    <?php endif;?>
    <div class="container header">
        <div class="col-sm-4">
            <h1><a href="/hand-made">Украшения и аксессуары ручной работы</a><small> от <a href="/">доставка 29</a></small></h1>
        </div>
        <div class="col-sm-4">
            <p style="margin-top: 26px; font-size: 16px">Украшения ручной работы с настоящими растениями, все товары сделаны только из натуральных матриалов, мы гарантируем бесплатнуб доставку по Архангельску в день заказа.</p>
        </div>
        <div class="col-sm-4" style="text-align: center">
            <button id="hand-made-cart-btn" style="display:none; margin-top: 50px" class="btn btn-lg"></button>
        </div>
    </div>

    <div style="min-height:100%; margin-bottom:-60px; padding-bottom:60px">
	   <?= $content ?>
	</div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Доставка 29. Ювелирнве украшения ручной работы  <?php echo \app\assets\ConfigHelper::getPartnerEmail();?> - контакт для партнеров</p>
        </div>
    </footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php $this->endBody() ?>
<?php echo $this->render('hand-made-cart'); ?><!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="<?php echo \Yii::$app->urlManager->createUrl(['/js/mustache.min.js']); ?>"></script>
<script src="<?php echo \Yii::$app->urlManager->createUrl(['/js/plugins/jquery.maskedinput.min.js'])?>"></script>
<script src="<?php echo \Yii::$app->urlManager->createUrl(['/js/hand-made/cart.js']); ?>"></script>
<?php echo $this->render('counters'); ?>
</body>
</html>
<?php $this->endPage() ?>
<link href='http://fonts.googleapis.com/css?family=Roboto:300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>