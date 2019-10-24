<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\Register */
/* @var $form yii\widgets\ActiveForm */
$userList = ArrayHelper::map(User::find()->orderBy('id')->asArray()->all(), 'id', 'fullname');

?>

<div class="register-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userId')->dropDownList($userList,['prompt'=>Yii::t('app', 'Seleccione el usuario')],['itemOptions' => ['labelOptions' => ['class' => 'col-md-12']]]) ?>

    <?= $form->field($model, 'codeId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'point')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
