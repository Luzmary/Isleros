<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Reward;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\Redencion */
/* @var $form yii\widgets\ActiveForm */

$listReward = ArrayHelper::map(Reward::find()->all(), 'id', 'name' ); 
$listUser = ArrayHelper::map(User::find()->where(['role' => 1 ])->all(), 'id', 'fullname' ); 


?>

<div class="redencion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rewardId')->dropDownList($listReward,['prompt'=>Yii::t('app', 'Selecciona el Premio')],['itemOptions' => ['labelOptions' => ['class' => 'col-md-12']]]) ?>

    <?= $form->field($model, 'userId')->dropDownList($listUser,['prompt'=>Yii::t('app', 'Selecciona el Usuario')],['itemOptions' => ['labelOptions' => ['class' => 'col-md-12']]]) ?>

    <?= $form->field($model, 'status')->dropDownList([1 => 'Redimido', 0 =>'No Redimido'],['prompt'=>Yii::t('app', 'Premio redimido ?')],['itemOptions' => ['labelOptions' => ['class' => 'col-md-12']]]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Crear') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
