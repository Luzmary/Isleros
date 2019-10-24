<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Redencion */
?>
<div class="redencion-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'reward.name',
            'user.fullname',
            'user.email',
            'user.phone',
            'enabled',
            'date',
        ],
    ]) ?>

</div>
