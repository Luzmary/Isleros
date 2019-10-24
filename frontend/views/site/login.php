<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;


$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


    <!-- Contenido -->
    <div class="background-cover">
      <div class="logo2">
        <img src=<?= Yii::getAlias('@web').'/img/logo2.png' ?> alt="" width="100%">
      </div>
      <div class="container">
        
          <?php $form = ActiveForm::begin(['id' => 'login-form',
            'options' => [
                'class' => 'inicio-sesion'
             ]]); ?>

             <p class="h4 mb-4 text-center">INICIO SESION</p>
                <?= $form->field($model, 'personalId',[
                    'template' => '
                        <div class="input-group mb-3">
                            {input}
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fa fa-user emerald"></i>
                                </div>
                            </div>                           
                        </div>
                        {error}',
                    'inputOptions' => [
                        'placeholder' => 'Identificación',
                        'class'=>'form-control py-0',
                    ]])
                ?>

                <?= $form->field($model, 'password',[
                    'template' => '
                        <div class="input-group mb-3">
                            {input}
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fas fa-unlock-alt"></i>
                                </div>
                            </div>                           
                        </div>
                        {error}',
                    'inputOptions' => [
                        'placeholder' => 'Contraseña',
                        'class'=>'form-control py-0',
                    ]])->input('password')
                ?>

                <div class="d-flex justify-content-between">
                  <div class="msj-contrasena">
                      <?= Html::a('¿Olvidaste la contraseña?', ['site/request-password-reset']) ?>
                  </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('INGRESAR', ['class' => 'flex-center btn btn-rounded my-4 btn-inicio-sesion', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="container">
            <div class="flex-center flex-column mt-3">
                <div class="msj-contrasena">
                  <a href="">¿Aún no tienes cuenta?</a>
                </div>
                <?= Html::a('REGÍSTRATE', ['user/create'], ['class' => 'btn btn-rounded my-4 btn-inicio-sesion']) ?> 
                <?= Html::a('AYUDA', ['site/contact'], ['class' => 'btn btn-rounded my-4 btn-inicio-sesion']) ?> 
              </div>
            </div>
        </div>
          
      </div>
    </div>


