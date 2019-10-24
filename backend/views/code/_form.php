<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Campaign;

/* @var $this yii\web\View */
/* @var $model common\models\Code */
/* @var $form yii\widgets\ActiveForm */

$listCamp= ArrayHelper::map(Campaign::find()->all(), 'id', 'name' ); 

?>

<div class="code-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'campaignId')->dropDownList($listCamp,['prompt'=>Yii::t('app', 'Selecciona la campaña')],['itemOptions' => ['labelOptions' => ['class' => 'col-md-12']]]) ?>

    <?= $form->field($model, 'point')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([1 => 'Usado', 0 =>'No usado'],['prompt'=>Yii::t('app', 'Código Usado ?')],['itemOptions' => ['labelOptions' => ['class' => 'col-md-12']]]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
