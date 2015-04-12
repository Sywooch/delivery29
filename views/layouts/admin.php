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
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
        <?php
            NavBar::begin([
                'brandLabel' => 'Админ панель',
                'brandUrl' => "/admin",
                'options' => [
                    'class' => 'navbar-inverse navbar-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Все товары', 'url' => ['/adm-product']],
                    ['label' => 'Зоны доставки', 'url' => ['/delivery-zone']],
                    ['label' => 'Пользователь', 'url' => ['/user']],
                    ['label' => 'Заказы', 'url' => ['/adm-order']],
                    ['label' => 'Параметры', 'url' => ['/params']],
                    ['label' => 'Катагории товаров', 'url' => ['/adm-category']],
                    ['label' => 'Подкатагории товаров', 'url' => ['/adm-sub-category']],
                ],
            ]);
            NavBar::end();
        ?>
        <?= $content ?>

    <footer class="footer">
        <div class="container">
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
<script src="<?php echo \Yii::$app->urlManager->createUrl(['/js/mustache.min.js']);?>"></script>
</html>
<?php $this->endPage() ?>
