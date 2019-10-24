<?php
	use yii\widgets\ActiveForm;
	use yii\helpers\Html;
?>

<div class="upcode">
<h1>Cargar Códigos</h1>
<?php $form = ActiveForm::begin(['action'=>['code/name'],'options'=>['enctype'=>'multipart/form-data']]);?>

<?= $form->field($modelImport,'fileImport')->fileInput()->label('Subir Archivo') ?>

<?= Html::submitButton('Importar',['class'=>'btn btn-primary']);?>

<?php ActiveForm::end();?>
</div>
