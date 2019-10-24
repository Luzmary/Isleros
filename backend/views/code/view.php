<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Code */
?>
<div class="code-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cod',
            'campaign.name',
            'point',
            'created_at',
            'enabled',
        ],
    ]) ?>

</div>
