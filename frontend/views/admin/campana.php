<?php
use yii\helpers\Html;

?>


    <div class="background-gris">
      <!--Header-->
      <?php echo $this->render('_miniheader',['idStation'=>$idStation]); ?>

      <!--/.Double navigation-->
      <!-- Banner-->
      <div class="banner-texto">
        <a type="button" class="btn-floating btn-lg btn-yt"><i class="fas fa-headset"></i></a> 
        <h4>CAMPAÑA</h4>
      </div>
      <!-- Contenido-->
      <div class="contenido-campana">
        <div class="modulo-campana">
          <h4>Total</h4>
          <h4>Puntos isla</h4>
        </div>
        <div class="modulo-campana">
          <a type="button" class="btn-floating btn-lg btn-yt">
            <h3>+ <?= $totalPoint ?></h3>
            <h5>PUNTOS</h5>
          </a>
        </div>
        <div class="modulo-campana" style="width: 100%;">
          <div class="titulo-campana">
            <h4><?= $camp->name ?></h4>
          </div>
          <div class="fecha-campana">
            <div class="fechas">
              <h5>fecha de inicio</h5>
              <h6><?= date_format(date_create($camp->start_date),"m-d-Y") ?> </h6>
            </div>
            <div class="fechas">
              <h5>fecha de fin</h5>
              <h6><?= date_format(date_create($camp->end_date),"m-d-Y") ?> </h6>
            </div>
          </div>
        </div>     
      </div>
      <!-- /Contenido-->
      <!-- Footer -->
          <?php echo $this->render('_footer'); ?>
      <!-- Footer -->
    </div>