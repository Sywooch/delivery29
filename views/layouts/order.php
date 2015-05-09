<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

if (!function_exists("isActive")) {
    function isActive($url)
    {
        if (strpos($_SERVER['REQUEST_URI'], $url) !== false) {
            if ($url == "/" && $_SERVER['REQUEST_URI'] == "/" || $url != "/")
                return "active";
        }
        return "";
    }
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="<?php echo \app\assets\ConfigHelper::getDescription()?>">
    <meta name="keywords" content="<?php echo \app\assets\ConfigHelper::getKeywords()?>">
    <link href="<?php echo \Yii::$app->urlManager->createUrl('/css/style.css?v1'). \app\assets\ConfigHelper::getVer()?>" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
</head>
<body>

<?php $this->beginBody() ?>
<?php
NavBar::begin([
    'brandLabel' => 'Доставка 29',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-top',
        'style' => "z-index:995",
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => [
        ['label' => 'Доставка еды из Макдоналдс и Старфудс домой или в офис ежедневнно с 16:00 до 23:00', 'url' => ['/']],
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => 'Зоны доставки', 'url' => ['/zone']],
        ['label' => 'Режим работы', 'url' => ['/work']],
    ],
]);
NavBar::end();
?>
<div style="min-height:100%; margin-bottom:-60px; padding-bottom:60px">
    <?= $content ?>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Доставка еды из Макдональдс Старфудс в Архангельске <?php echo \app\assets\ConfigHelper::getPartnerEmail();?> - контакт для партнеров</p>

    </div>
</footer>

<?php $this->endBody() ?>
<script src="<?php echo \Yii::$app->urlManager->createUrl(['/js/mustache.min.js']);?>"></script>
<?php echo $this->render('delivery-zone')?>
<script>
    var ADD_DELIVERY_PRICE = '<?php echo Yii::$app->params['ADD_DELIVERY_PRICE']?>';
</script>
<script src="<?php echo \Yii::$app->urlManager->createUrl(['/js/chart.js']);?>"></script>
<?php echo $this->render('counters'); ?>
</body>
<script src="<?php echo \Yii::$app->urlManager->createUrl(['/js/plugins/jquery.maskedinput.min.js'])?>"></script>
</html>
<?php $this->endPage() ?>
