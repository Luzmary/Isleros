<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Petición para la recuperación de contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="background-cover">
<?php echo $this->render('_miniheader'); ?>

    <div class="container">
        <div class="banner">
            <div class="view">
                <p class="h4 mb-4 text-center" style="font-size: 14px;
    margin-top: 50px;color:#fff;">Por favor complete su correo electrónico. Allí se enviará un enlace para restablecer la contraseña.</p>
            </div>
        </div>
      <!--Header-->
      
        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true,'placeholder'=>'Email'])->label(false); ?>
                
                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'flex-center btn btn-rounded my-4 btn-inicio-sesion', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
