<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="">
      <!--Header-->
    <header>
        <!-- Navbar -->
        <nav class="navbar  navbar-toggleable-md navbar-expand-lg double-nav no-padding2" style="padding: 0;">
          <!-- SideNav slide-out button -->
          <div class="bar-logos" style="width: 10%; color: #f8d426;  color: black;">
            <i class="fas fa-undo"></i>
          </div>
          <!-- logo nav-->
          <div class="bar-logos" style="background: #fff100;">
              <img src=<?= Yii::getAlias('@web')."/img/simoniz.png" ?> alt="">
          </div>
          <div class="bar-logos" style="background: #e1251b;">
              <img src=<?= Yii::getAlias('@web')."/img/logo.png" ?> alt="">
          </div>
          <div class="bar-logos"  style="background: #b21e1b;">
              <img src=<?= Yii::getAlias('@web')."/img/logo-islero.png" ?> alt="">
          </div>
          <!--/.Logo nav-->
        </nav>
        <!-- /.Navbar -->
    </header>
      <!--/.Double navigation-->
    <div class="container">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
          <div class="formulario-header">
              <div class="modulo-form">
                <div class="circle">
                  <!-- User Profile Image -->
                  <img class="profile-pic" src=<?= Yii::getAlias('@web')."/img/avatar-cuenta.png"?> alt="">
                </div>
                <div class="p-image">
                    <i class="fas fa-camera upload-button"></i>
                    <input class="file-upload" type="file" accept="image/*"/>
                </div>
                <div class="p-image2">
                    <i class="far fa-edit upload-button2"></i>
                    <input class="file-upload2" name="avatar" type="file" accept="image/*"/>
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

                <?= $form->field($model, 'fullname',[
                    'template' => '
                        {input} 
                        {error}',
                        'options' => [
                            'tag' => false, // Don't wrap with "form-group" div
                        ],
                        'inputOptions' => [
                            'placeholder' => 'CÉDULA',
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
                    ]])->dropDownList([
                        1 => 'item 1', 
                        2 => 'item 2'
                    ],
                    ['prompt'=>'DEPARTAMENTO','onchange'=>'$.get("../user/get-city?id='.'"+$(this).val(),function(data){
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
                    ]])->dropDownList([
                        1 => 'item 1', 
                        2 => 'item 2'
                    ],
                    ['prompt'=>'CIUDAD','readonly'=> true, 'disabled' => 'disabled',
                    'onchange'=>'$.get("../user/get-station?id='.'"+$(this).val(),function(data){
                        $("select#station-id").attr("disabled",false); 
                        $("select#station-id").attr("readonly",false); 
                        $("select#station-id").html(data);
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
                    ]])->dropDownList([
                        1 => 'item 1', 
                        2 => 'item 2'
                    ],
                    ['prompt'=>'ESTACIÓN','readonly'=> true, 'disabled' => 'disabled',
                    'onchange'=>'$.get("../user/get-brand?id='.'"+$(this).val(),function(data){
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
                        'placeholder' => 'Password',
                        'class'=>'browser-default custom-select',
                    ]])->dropDownList([
                        1 => 'item 1', 
                        2 => 'item 2'
                    ],
                    ['prompt'=>'MARCA / BANDERA','readonly'=> true, 'disabled' => 'disabled'])
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
            <?= Html::submitButton('REGISTRATE', ['class' => 'btn btn-info', 'name' => 'signup-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
    



