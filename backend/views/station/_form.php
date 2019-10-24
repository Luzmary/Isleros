<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\City;
use common\models\Brand;

/* @var $this yii\web\View */
/* @var $model common\models\Station */
/* @var $form yii\widgets\ActiveForm */
$listCity= ArrayHelper::map(City::find()->all(), 'id', 'nombre' ); 
$listBrand= ArrayHelper::map(Brand::find()->all(), 'id', 'name' ); 

?>

<div class="station-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cityId')->dropDownList($listCity,['prompt'=>Yii::t('app', 'Selecciona la ciudad')],['itemOptions' => ['labelOptions' => ['class' => 'col-md-12']]]) ?>

    <?= $form->field($model, 'brandId')->dropDownList($listBrand,['prompt'=>Yii::t('app', 'Selecciona la marca')],['itemOptions' => ['labelOptions' => ['class' => 'col-md-12']]]) ?>


  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
