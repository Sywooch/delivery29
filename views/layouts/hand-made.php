<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

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
    <div class="container header">
        <h1><a href="/hand-made">Украшения и аксессуары ручной работы</a><small> от доставка 29</small></h1>
        <p>Украшения ручной работы с настоящими растениями. Бесплатная доставка по Архангельску</p>
    </div>

    <div style="min-height:100%; margin-bottom:-60px; padding-bottom:60px">
	   <?= $content ?>
	</div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Доставка 29. Ювелирнве украшения ручной работы  <?php echo \app\assets\ConfigHelper::getPartnerEmail();?> - контакт для партнеров</p>
        </div>
    </footer>

<?php $this->endBody() ?>
<script src="<?php echo \Yii::$app->urlManager->createUrl(['/js/mustache.min.js']); ?>"></script>
<?php echo $this->render('delivery-zone')?>
<script>
    var ADD_DELIVERY_PRICE = '<?php echo Yii::$app->params['ADD_DELIVERY_PRICE']?>';
</script>
<script src="<?php echo \Yii::$app->urlManager->createUrl(['/js/chart.js']); ?>"></script>
<?php echo $this->render('counters'); ?>
</body>
</html>
<?php $this->endPage() ?>
<link href='http://fonts.googleapis.com/css?family=Roboto:300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>