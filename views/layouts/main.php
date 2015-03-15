<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
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
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
        <?php
            NavBar::begin([
                'brandLabel' => 'Доставка 29',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Еда', 'url' => ['/']],
                    ['label' => 'Зоны доставки', 'url' => ['/zone']],
                    ['label' => 'Режим работы', 'url' => ['/work']],
                ],
            ]);
            NavBar::end();
        ?>
        <?= $content ?>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Доставка еды из Макдональдс Старфудс в Архангельске <?= date('Y') ?></p>
            
        </div>
    </footer>

<?php $this->endBody() ?>
<script src="/js/mustache.min.js"></script>
<?php echo $this->render('delivery-zone')?>
<script src="/js/chart.js"></script>
</body>
</html>
<?php $this->endPage() ?>
