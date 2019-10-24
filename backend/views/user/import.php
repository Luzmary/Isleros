<?php
	use yii\widgets\ActiveForm;
	use yii\helpers\Html;
?>

<div class="upcode">
<h1>Cargar Usuarios</h1>
<?php $form = ActiveForm::begin(['action'=>['user/usuarios'],'options'=>['enctype'=>'multipart/form-data']]);?>
<?= $form->errorSummary($modelImport, ['header' => 'POR FAVOR REVISE LOS SIGUIENTES ERRORES:']); ?>
<?= $form->field($modelImport,'fileImport')->fileInput()->label('Subir Archivo') ?>

<?= Html::submitButton('Importar',['class'=>'btn btn-primary']);?>

<?php ActiveForm::end();?>
</div>
