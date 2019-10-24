<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Register */
?>
<div class="register-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user.fullname',
            'codeId',
            'code.point',
            'created_at',
        ],
    ]) ?>

</div>
