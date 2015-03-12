<?php

namespace app\commands;

use yii\console\Controller;
use app\models;
class PostUpdateController extends Controller
{
    public function actionIndex()
    {
        $pf = new \app\models\PostFounder;
        $pf->update();
    }
}
