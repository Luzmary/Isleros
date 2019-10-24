<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Reward */
?>
<div class="reward-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'puntos',
            'created_at',
        ],
    ]) ?>

</div>
