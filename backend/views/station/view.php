<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Station */
?>
<div class="station-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'address',
            'phone',
            'cityId',
            'brandId',
            'created_at',
        ],
    ]) ?>

</div>
