<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Code;
use common\widgets\Alert;
use yii\widgets\LinkPager;

?>

      <!-- Header -->
        <?php echo $this->render('_miniheader'); ?>
      <!--/ Header -->
      <!-- banner -->
      <div class="banner-texto no-background">
        <a type="button" class="btn-floating btn-lg btn-yt"><i class="fas fa-clipboard-list"></i></a> 
          <h4>TUS CODIGOS<br>
          <span><? print_r(date('m/d/Y', time())) ?></span>
        </h4>
      </div>
      <div class="isalert">
          <?= Alert::widget() ?>
      </div>
      <div class="banner-rojo">
        <?php $form = ActiveForm::begin(['id' => 'form-code']); ?>
        <?= $form->errorSummary($modelRegiterCode, ['header' => 'POR FAVOR REVISE LOS SIGUIENTES ERRORES:']); ?>

          <div class="contenido-banner-rojo">

            <?= $form->field($modelRegiterCode, 'codeId',[
                    'template' => '
                        {input}',
                        'options' => [
                            'tag' => false, // Don't wrap with "form-group" div
                        ],
                        'inputOptions' => [
                            'placeholder' => '1xyzw',
                            'class'=>'form-control',
                        ]])
                ?>

            <?= Html::submitButton(Html::img(Yii::getAlias('@web')."/img/add.png"), ['class' => 'btn-add', 'name' => 'code-button']) ?>

            
          </div>
        <?php ActiveForm::end(); ?>
        <div class="titulo-banner-rojo">
            Registra el código que aparece en el producto
        </div>
      </div>
      <!-- / banner -->
      <!-- Contenido -->
      <div class="resultados no-margin">
        <div class="container">
          <div class="resultados-interna no-margin">
            
           <div class="resultado-interna-cuadro">
              <div class="resultado-interna-titulo">
                <h5>FECHA</h5>
              </div>

              <? foreach ($dataProvider->models as $model) { ?>
                <div class="resultado-interna-caja">
                  <?php $date = date_create($model->created_at); ?>
                  <?= date_format($date,"M j Y ")  ?>
                </div>
              <?php } ?>
          </div>
          <div class="resultado-interna-cuadro">
              <div class="resultado-interna-titulo">
                <h5>PUNTOS</h5>
              </div>
              <? foreach ($dataProvider->models as $model) { ?>
                <div class="resultado-interna-caja">
                  + <?= $model->point; ?>
                </div>
              <?php } ?>
          </div> 
          <div class="resultado-interna-cuadro">
              <div class="resultado-interna-titulo">
                <h5>CÓDIGO</h5>
              </div>
              <? foreach ($dataProvider->models as $model) { ?>
                <div class="resultado-interna-caja">
                  <?= $model->codeId; ?>
                </div>
              <?php } ?>
            </div>
            
          </div>
          <div class="btn-vermas">
              <?php echo LinkPager::widget(['pagination' => $pagination]); ?>
          </div>
        </div>
      </div>