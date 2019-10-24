<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Brand */
?>
<div class="brand-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'logo',
            'created_at',
        ],
    ]) ?>

</div>
