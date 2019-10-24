<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;
?>


<div>
      <!-- Header -->
              <?php echo $this->render('_miniheader'); ?>

      <!-- Banner -->
      <div class="banner-texto no-background">
        <a type="button" class="btn-floating btn-lg btn-yt"><i class="fas fa-clipboard-list"></i></a> 
        <h4>LISTA DE PREMIOS<br>
          <span><? print_r(date('m/d/Y', time())) ?> </span>
        </h4>
      </div>
      <!-- / Banner -->
      <!-- Contenido -->

      <div class="banner-rojo">
        <div class="contenido-banner-rojo">
          <a type="button" class="btn-floating btn-lg btn-yt waves-effect waves-light puntos">
            <h3><?= $countPoint ?></h3>
            <h5>PUNTOS</h5>
          </a>
          <h3>TUS PUNTOS</h3>
        </div>
      </div>
      <div class="isalert">
              <?= Alert::widget() ?>
      </div>
        <div class="premios">
         <div class="container">
            <?php foreach ($modelReward as $key => $value) { ?>
          <div class="cuadro-resultados">
            <div class="avatar-resultados">
              <img src=<?= Yii::getAlias('@web')."/img/premio1.png" ?> alt="">
            </div>
            <div class="datos-resultados">
              <h5><?= $value->name ?></h5>
            </div>
            <div class="puntaje">
            	<?= Html::a(Html::tag('button', '<h4>'.$value->puntos.'</h4>'.'<h5>PUNTOS</h5>', ['class' => 'btn-floating btn-lg btn-yt']), ['user/redimir','id'=>$value->id],[['class' => '']]) ?>
            </div>

          </div>

          <?php } ?>

        </div>
      </div>

      
</div>