<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="background-cover">
      <!--Header-->
      <? Url::remember(); ?>
      <?php  echo $this->render('_header',['idStation'=>$idStation]); ?>

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
          <?= Html::a(Html::img(Yii::getAlias('@web')."/img/btn-campana.png"), ['admin/campana'],['data'=>['method' => 'post','params'=>['idStation'=>$idStation],]]); ?>
          <?= Html::a(Html::img(Yii::getAlias('@web')."/img/btn-usuarios.png"), ['admin/users','id'=>$idStation]) ?>
          <?= Html::a(Html::img(Yii::getAlias('@web')."/img/btn-contactar.png"), ['admin/contact'],['data'=>['method' => 'post','params'=>['idStation'=>$idStation],]]); ?>
          <?= Html::a(Html::img(Yii::getAlias('@web')."/img/btn-cerrar.png"), ['site/logout'],['data' => ['method' => 'post']]); ?>

        </div>
      </div>
      <!-- Contenido-->
      <!-- Footer -->
      <?php echo $this->render('_footer'); ?>
      <!-- Footer -->
 </div>