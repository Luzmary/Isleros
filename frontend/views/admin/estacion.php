<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


$stationList = ArrayHelper::map($listStation, 'id', 'name');

?>


    <?php echo $this->render('_header'); ?>

    <!-- Banner-->
    <div class="banner">
      <div class="view">
        <img src=<?= Yii::getAlias('@web').'/img/banner.jpg' ?> class="img-fluid">
          <div class="mask flex-center waves-effect waves-light">
            <figure>
              <img src=<?= Yii::getAlias('@web').'/img/avatar-banner.png' ?> alt="">
            </figure>
            <h4><?=  strtoupper(Yii::$app->user->identity->fullname);?></h4>
            <h5>Bogotá - Colombia</h5>
          </div>
      </div>
    </div>
    <!-- / Banner-->

    <!-- Contenido -->
    <section class="contenido-selection">
      <div class="title-selection">
        <div class="icono-selection">
          <a class="btn-floating btn-lg danger-color-dark">
            <i class="fas fa-gas-pump"></i>
          </a>
        </div>
        <div class="texto-selection">
          Seleccione <br> estación
        </div>
      </div>
      <div class="form-selection">
        <?php $form = ActiveForm::begin(['action' => 'home','method'=>'post']); ?>

        <?= $form->field($model, 'id')->dropDownList($stationList,
                ['prompt'=>Yii::t('app', 'Please Choose One'),
                'onchange'=>'this.form.submit()','style'=>'display:block !important'])->label(false) ?>

        <?php ActiveForm::end(); ?> 

      </div>

    </section> 
    <!-- / Contenido -->
    <!-- Footer -->
    <?php echo $this->render('_footer'); ?>
    <!-- Footer -->
    