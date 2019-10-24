<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\City;
use common\models\Station;
use common\models\State;
use common\models\Brand;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;

$listCity= ArrayHelper::map(City::find()->orderBy('nombre')->all(), 'id', 'nombre' ); 
$listState= ArrayHelper::map(State::find()->orderBy('name')->all(), 'id', 'name' ); 
$listStation = ArrayHelper::map(Station::find()->orderBy('name')->all(), 'id', 'name' );
$listBrand= ArrayHelper::map(Brand::find()->orderBy('name')->all(), 'id', 'name' );

if($model->stationId) {
    
   $checkedStation = Station::find()->where(['id' => $model->stationId] )->one(); //get selected value from db if value exist
   $city = City::find()->where(['id' => $checkedStation->cityId] )->one();
   $modelCity->id = $city->id;
   $state = State::find()->where(['id' => $city->stateId] )->one();
   $modelState->id = $state->id;
   //$brand = Brand::find()->where(['id' => $checkedStation->brandId] )->one();
   $modelStation->id = $checkedStation->id;
   $modelStation->brandId = $checkedStation->brandId;


}

?>


<div class="">
      <!--Header-->
        <?php echo $this->render('_miniheader'); ?>

      <!--/.Double navigation-->
    <div class="container">
        <?php $form = ActiveForm::begin(['id' => 'form-signup','options' => ['enctype'=>'multipart/form-data']]); ?>
        <?= $form->errorSummary($model, ['header' => 'POR FAVOR REVISE LOS SIGUIENTES ERRORES:']); ?>

          <div class="formulario-header">
              <div class="modulo-form">
                <div class="circle">
                  <!-- User Profile Image -->
                  <?php 
                   if($model->avatar) {
                        $img_url =  $model->avatar;
                   } else {
                       $img_url = "img/avatar-cuenta.png";
                   }

                  ?>
                  <img class="profile-pic" src=<?= Yii::getAlias('@web').'/'.$img_url;?> alt="">
                </div>
                <div class="p-image">
                    <i class="fas fa-camera upload-button"></i>
                    <input class="file-upload" type="file" accept="image/*"/>
                </div>
                <div class="p-image2">
                    <i class="far fa-edit upload-button2"></i>
                    <?= $form->field($model, 'avatar',[
                    'template' => '
                        {input} 
                        {error}',
                        'options' => [
                            'tag' => false, // Don't wrap with "form-group" div
                        ],
                        'inputOptions' => [
                            'placeholder' => 'NOMBRE',
                            'class'=>'file-upload2',
                            'type'=>'file',
                            'accept'=>'image/*'
                        ]])
                ?>
                </div>
              </div>
              <div class="modulo-form2">
                <?= $form->field($model, 'fullname',[
                    'template' => '
                        {input} 
                        {error}',
                        'options' => [
                            'tag' => false, // Don't wrap with "form-group" div
                        ],
                        'inputOptions' => [
                            'placeholder' => 'NOMBRE',
                            'class'=>'form-control',
                        ]])
                ?>

                <?= $form->field($model, 'personalId',[
                    'template' => '
                        {input} 
                        {error}',
                        'options' => [
                            'tag' => false, // Don't wrap with "form-group" div
                        ],
                        'inputOptions' => [
                            'placeholder' => 'CÉDULA', 
                            'disabled' => $model->isNewRecord ? false : 'disabled',
                            'class'=>'form-control',
                        ]])
                ?>
              </div>
          </div>
        <div class="formulario-content">
            <?= $form->field($model, 'phone',[
                    'template' => '
                        {input} 
                        {error}',
                        'options' => [
                            'tag' => false, // Don't wrap with "form-group" div
                        ],
                        'inputOptions' => [
                            'placeholder' => 'CELULAR',
                            'class'=>'form-control',
                        ]])
                ?>
            <?= $form->field($modelState, 'id',[
                    'template' => '
                        {input} 
                        {error}',
                        'options' => [
                            'tag' => false, // Don't wrap with "form-group" div
                        ],
                    'inputOptions' => [
                        'class'=>'browser-default custom-select',
                    ]])->dropDownList($listState,
                    ['prompt'=>'DEPARTAMENTO', 'readonly' => $model->isNewRecord ? true : true, 'disabled' => $model->isNewRecord ? false : 'disabled',
                    'onchange'=>'$.get("../user/get-city?id='.'"+$(this).val(),function(data){
                        $("select#city-id").attr("disabled",false); 
                        $("select#city-id").attr("readonly",false); 
                        $("select#city-id").html(data);
                    })'])
            ?>
            

            <?= $form->field($modelCity, 'id',[
                    'template' => '
                        {input} 
                        {error}',
                        'options' => [
                            'tag' => false, // Don't wrap with "form-group" div
                        ],
                    'inputOptions' => [
                        'class'=>'browser-default custom-select',
                    ]])->dropDownList($listCity,
                    ['prompt'=>'CIUDAD','readonly'=> true, 'disabled' => 'disabled',
                    'onchange'=>'$.get("../user/get-marca?id='.'"+$(this).val(),function(data){
                        $("select#station-brandid").attr("disabled",false); 
                        $("select#station-brandid").attr("readonly",false); 
                        $("select#station-brandid").html(data);
                    })'])
            ?>

            <?= $form->field($modelStation, 'brandId',[
                    'template' => '
                        {input} 
                        {error}',
                        'options' => [
                            'tag' => false, // Don't wrap with "form-group" div
                        ],
                    'inputOptions' => [
                        'class'=>'browser-default custom-select',
                    ]])->dropDownList($listBrand,
                    ['prompt'=>'Marca','readonly'=> true, 'disabled' => 'disabled',
                    'onchange'=>'$.ajax({
                        type: "GET",
                        url: "../user/get-station",
                        data: { id: $(this).val(), idCity: $("#city-id").val() },
                        success: function(result){
                            $("select#station-id").attr("disabled",false); 
                            $("select#station-id").attr("readonly",false); 
                            $("select#station-id").html(result);
                        }
                    })'])
                    ?>

            <?= $form->field($modelStation, 'id',[
                    'template' => '
                        {input} 
                        {error}',
                        'options' => [
                            'tag' => false, // Don't wrap with "form-group" div
                        ],
                    'inputOptions' => [
                        'placeholder' => 'Password',
                        'class'=>'browser-default custom-select',
                    ]])->dropDownList([$listStation],
                    ['prompt'=>'ESTACIÓN', 'readonly'=> true, 'disabled' => 'disabled',])
            ?>

            


            <?= $form->field($model, 'email',[
                    'template' => '
                        {input} 
                        {error}',
                        'options' => [
                            'tag' => false, // Don't wrap with "form-group" div
                        ],
                        'inputOptions' => [
                            'placeholder' => 'CORREO',
                            'class'=>'form-control',
                        ]])->input('email')
            ?>

            <?= $form->field($model, 'password',[
                    'template' => '
                        {input} 
                        {error}',
                        'options' => [
                            'tag' => false, // Don't wrap with "form-group" div
                        ],
                        'inputOptions' => [
                            'placeholder' => 'CLAVE',
                            'class'=>'form-control',
                        ]])->input('password')
            ?>
            <?= $form->field($model, 'passwordConfirm',[
                    'template' => '
                        {input} 
                        {error}',
                        'options' => [
                            'tag' => false, // Don't wrap with "form-group" div
                        ],
                        'inputOptions' => [
                            'placeholder' => 'CONFIRMAR CLAVE',
                            'class'=>'form-control',
                        ]])->input('password')
            ?>             

            <!-- Material inline 1 -->
            <div class="form-check form-check-inline">
              <input type="checkbox" class="form-check-input" id="materialInline1">
              <label class="form-check-label" for="materialInline1">ACEPTO TÉRMINOS Y CONDICIONES</label>
            </div>
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'REGISTRATE') : Yii::t('app', 'Actualizar'), ['class' => 'btn btn-info', 'name' => 'signup-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
    



