<?php
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\User;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'width' => '7%',
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'rewardId',
        'value'=>'reward.name'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'userId',
        'value'=>'user.fullname',
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(User::find()->orderBy('id')->asArray()->all(), 'id', 'fullname'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
        'filterInputOptions'=>['placeholder'=>'Usuarios'],
        'format' => 'html'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label'=>'Correo',
        'attribute'=>'userId',
        'value'=>'user.email'
    ],
        [
        'class'=>'\kartik\grid\DataColumn',
        'label'=>'Telefono',
        'attribute'=>'userId',
        'value'=>'user.phone'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'value' => 'enabled',
        'filter'=> array(1 => 'Redimido', 0 =>'No Redimido'),
    ],


];   