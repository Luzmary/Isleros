<?php
use yii\helpers\Html;
use common\widgets\Alert;

?>


<div class="background-cover">
      <!--Header-->
        <?php echo $this->render('_header'); ?>

      <!--/.Double navigation-->
      <!-- Banner-->
      <div class="isalert">
          <?= Alert::widget() ?>
      </div>
      <div class="banner-texto flex-center flex-column">
        <h5>Hola</h5>
        <h4><?=  strtoupper(Yii::$app->user->identity->fullname);?></h4>
      </div>
      <!-- Contenido-->
      <div class="contenido-campana">
        <div class="modulo-campana">
          <a type="button" class="btn-floating btn-xl btn-yt">
            <h3>+ <?= $countPoint ?></h3>
            <h5>PUNTOS</h5>
            <span><?= $camp->name ?></span>
            <span><?= date_format(date_create($camp->start_date),"m-d-Y") .' A '. date_format(date_create($camp->end_date),"m-d-Y") ?></span>

          </a>
        </div>
        <div class="modulo-campana" style="width: 100%;">
          <div class="fecha-campana">
            <div class="fechas">
            	<?= Html::a(Html::img(Yii::getAlias('@web')."/img/btn-tus-codigos.png"), ['user/codigo']); ?>
          		<?= Html::a(Html::img(Yii::getAlias('@web')."/img/btn-redimir-puntos.png"), ['user/redencion']); ?>
            </div>
            <div class="fechas">
                <?= Html::a(Html::img(Yii::getAlias('@web')."/img/btn-contactar.png"), ['site/contact']); ?>
                <?= Html::a(Html::img(Yii::getAlias('@web')."/img/btn-cerrar.png"), ['site/logout'],['data' => ['method' => 'post']]); ?>
            </div>
          </div>
        </div>
      </div>
      <!-- /Contenido-->
      <!-- Footer -->
       <?php echo $this->render('_footer'); ?>

      <!-- Footer -->
</div>
