<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error container">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?php if( in_array($_SERVER['HTTP_HOST'], ['dostavka29.loc', 'text.dostavka29.ru']) ) : ?>
        <pre>
        <?php print_r($exception)?>
        </pre>
    <?php endif;?>
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Фаталити
    </p>
    <p>
        Что то пошло не так...  
    </p>

</div>
