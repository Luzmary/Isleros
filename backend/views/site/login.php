<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Simoniz';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p class="text-center">Complete los siguientes campos para iniciar sesión:</p>

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'personalId')->textInput(['autofocus' => true])->label('Identificación'); ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Contraseña'); ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label('Recuerdame'); ?>

                <div class="form-group">
                    <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
