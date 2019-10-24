<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */
?>
<div class="user-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fullname',
            'email:email',
            'personalId',
            'phone',
            'rol.name',
            'station.name',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
