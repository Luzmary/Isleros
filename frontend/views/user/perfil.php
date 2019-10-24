<?php 
use yii\helpers\Html;

?>
<div class="background-cover">
      <!--Header-->
      <?php echo $this->render('_header'); ?>

      <!--/.Double navigation-->
      <!-- Contenido-->
      <div class="container">
        <div class="perfil">
          <figure>
            <img src=<?= Yii::getAlias('@web')."/img/avatar-banner.png" ?> alt="">
          </figure>
          <h4><?=  strtoupper(Yii::$app->user->identity->fullname); ?></h4>
          <h5>Estación</h5>
          <h5>Bogotá - Colombia</h5>
        </div>
        <div class="boton-perfil">
          <?= Html::a(Html::img(Yii::getAlias('@web')."/img/btn-campana.png"), ['site/campana']); ?>
          <?= Html::a(Html::img(Yii::getAlias('@web')."/img/btn-usuarios.png"), ['site/campana']); ?>
          <?= Html::a(Html::img(Yii::getAlias('@web')."/img/btn-contactar.png"), ['site/campana']); ?>
          <?= Html::a(Html::img(Yii::getAlias('@web')."/img/btn-cerrar.png"), ['site/logout'],['data' => ['method' => 'post']]); ?>

        </div>
      </div>
      <!-- Contenido-->
      <!-- Footer -->
      <?php echo $this->render('_footer'); ?>
      <!-- Footer -->
    </div>