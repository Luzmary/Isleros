<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

    <?php $form = ActiveForm::begin([
            'action' => ['users','id'=>$idStation],
            'method' => 'get',
            'options' => [
            'data-pjax' => 1
          ],
        ]); ?>
                <div class="input-group md-form form-sm form-2 pl-0">
                  <?= $form->field($model, 'fullname',[
                    'template' => '
                        {input} 
                        {error}',
                        'options' => [
                            'tag' => false, // Don't wrap with "form-group" div
                        ],
                        'inputOptions' => [
                            'placeholder' => 'Buscar',
                            'class'=>'form-control my-0 py-1 amber-border',
                            'aria-label'=>"Search",
                        ]])
                  ?>


                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-text1">
                      <i class="fas fa-search text-grey" aria-hidden="true"></i>
                    </span>
                  </div>
                </div>
              
               <?= Html::submitButton(Html::img(Yii::getAlias('@web')."/img/add.png"), ['class' => 'btn-add']) ?>

    <?php ActiveForm::end(); ?>
