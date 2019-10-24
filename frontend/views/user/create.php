<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('app', 'Register');

?>

    <?= $this->render('_form', [
            'model' => $model,'modelStation'=>$modelStation,
            'modelState'=>$modelState, 'modelCity'=>$modelCity,
        ]) ?>
