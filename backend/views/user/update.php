<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,'modelRole' => $modelRole, 'modelStation'=>$modelStation,
    ]) ?>

</div>
