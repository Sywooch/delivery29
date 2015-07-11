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
    <link href="<?php echo \Yii::$app->urlManager->createUrl('/css/style.css?v1'). \app\assets\ConfigHelper::getVer()?>" rel="stylesheet">
    <meta name="title" content="Доставка еды из Макдоналдс и Старфудс">
    <meta name="description" content="<?php echo \app\assets\ConfigHelper::getDescription()?>">
    <meta name="keywords" content="<?php echo \app\assets\ConfigHelper::getKeywords()?>">
    <link rel="image_src" href="<?php echo \Yii::$app->urlManager->createUrl(['/img/logo.png']); ?>" />
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
           ?>
            <ul id="w1" class="navbar-nav nav">
                <li>
                    <a href="#">
                        Доставка еды
                        <span class="hidden-md hidden-sm hidden-xs">из Мак и Стар</span>
                        <span class="hidden-sm hidden-xs">домой или в офис</span> ежедневнно с
                        11:00 до 23:00</a>
                </li>
            </ul>
            <?php
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
        <div class="container">
            <div class="panel panel-danger">
                <div class="panel-body text-danger">
                По техническим причинам доставка не осуществляется до 29 июля, приносим извинения за неудобства.
            </div></div>
            <div class="col-sm-7 col-md-8 col-lg-9">
                <ul class="nav nav-tabs">
                    <li class="<?php echo isActive('/')?>"><a class='md-button' href="/">Мак</a></li>
                    <li class="<?php echo isActive('/star-foods')?>"><a  class='sf-button' href="<?php echo \Yii::$app->urlManager->createUrl(['/star-foods']); ?>">Стар</a></li>
                </ul>
                <br>
            </div>
        </div>
	   <?= $content ?>
	</div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Доставка еды из Мак и Стар в Архангельске <?php echo \app\assets\ConfigHelper::getPartnerEmail();?> - контакт для партнеров</p>
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
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>