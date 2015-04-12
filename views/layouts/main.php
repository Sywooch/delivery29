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
    <?php $this->head() ?>
    <meta name="title" content="Доставка еды из Макдоналдс и Старфудс">
    <meta name="description" content="Доставка, гамбургеров, ролов, снеков и многого другого из Макдоналдс и Старфудс в Архангельске">
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
                        <span class="hidden-md hidden-sm hidden-xs">из Макдоналдс и Старфудс</span>
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
            <div class="col-sm-7 col-md-8 col-lg-9">
                <ul class="nav nav-tabs">
                    <li class="<?php echo isActive('/')?>"><a class='md-button' href="/">Макдоналдс</a></li>
                    <li class="<?php echo isActive('/star-foods')?>"><a  class='sf-button' href="<?php echo \Yii::$app->urlManager->createUrl(['/star-foods']); ?>">Старфудс</a></li>
                </ul>
                <br>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php 
                    // echo $this->render('../global/category-menu');
                ?>
            </div>
        </div>
	   <?= $content ?>
	</div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Доставка еды из Макдональдс Старфудс в Архангельске</p>
            
        </div>
    </footer>

<?php $this->endBody() ?>
<script src="<?php echo \Yii::$app->urlManager->createUrl(['/js/mustache.min.js']); ?>"></script>
<?php echo $this->render('delivery-zone')?>
<script>
    var ADD_DELIVERY_PRICE = '<?php echo Yii::$app->params['ADD_DELIVERY_PRICE']?>';
</script>
<script src="<?php echo \Yii::$app->urlManager->createUrl(['/js/chart.js']); ?>"></script>
<?php if($_SERVER['HTTP_HOST'] != "dostavka29.loc"):?>
<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter29055700 = new Ya.Metrika({id:29055700, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/29055700" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
<?php endif;?>
</body>
</html>
<?php $this->endPage() ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>