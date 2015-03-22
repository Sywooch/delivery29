<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
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
    <meta name="description" content="Доставка, гамбургеров, ролов, снеков и многого другого из Макдоналд и Старфудс в Архангельске">
    <link rel="image_src" href="/img/logo.png" />
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
        <div class="container">
            <div class="col-sm-7 col-md-8 col-lg-9">
                <ul class="nav nav-tabs">
                    <li class="<?php echo isActive('/')?>"><a class='md-button' href="/">Макдоналдс</a></li>
                    <li class="<?php echo isActive('/star-foods')?>"><a  class='sf-button' href="/star-foods">Старфудс</a></li>
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
<script src="/js/mustache.min.js"></script>
<?php echo $this->render('delivery-zone')?>
<script>
    var ADD_DELIVERY_PRICE = '<?php echo Yii::$app->params['ADD_DELIVERY_PRICE']?>';
</script>
<script src="/js/chart.js"></script>
<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter29055700 = new Ya.Metrika({id:29055700, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/29055700" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</body>
</html>
<?php $this->endPage() ?>
