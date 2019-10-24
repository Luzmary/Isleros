<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Station;
use common\models\Role;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

$listRole= ArrayHelper::map(Role::find()->all(), 'id', 'name');
$listStation= ArrayHelper::map(Station::find()->all(), 'id', 'name' ); 


?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'role')->dropDownList($listRole,['prompt'=>Yii::t('app', 'Selecciona el rol del usuario')],['itemOptions' => ['labelOptions' => ['class' => 'col-md-12']]]) ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'personalId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'stationId')->dropDownList($listStation,['prompt'=>Yii::t('app', 'Selecciona la estación')],['itemOptions' => ['labelOptions' => ['class' => 'col-md-12']]]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>
    
    <?= $form->field($model, 'passwordConfirm')->passwordInput() ?>

   

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
