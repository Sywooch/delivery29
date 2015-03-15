<?php
use yii\helpers\Html;
$this->title = "Авторизация";
?>
<div class="site-error container">

    <h1>Вход</h1>
    <?php if ( !empty($message) ):?>
        <div class="alert alert-danger"><?php echo $message?></div>
    <?php endif;?>
    <form method="POST" action="/admin/login">
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
      <input type="checkbox" name="rememberMe" value="Y">
      <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    </form>
</div>
