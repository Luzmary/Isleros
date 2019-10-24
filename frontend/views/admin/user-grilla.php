<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
      <? Url::remember(['admin/users', 'id' => $idStation]); ?>

      <!--Header-->
      <?php  echo $this->render('_miniheader',['idStation'=>$idStation]); ?>

      <!--/.Double navigation-->
      <!-- Contenido-->
      <div class="resultados">
        <div class="container">
          <div class="tabla-resultados">
            <div class="cuadro-resultados ir">
              <div class="avatar-resultados">
                <img src=<?= Yii::getAlias('@web').'/img/avatar-resultado.png' ?> alt="">
              </div>
              <div class="datos-resultados">
                <h5><?=  strtoupper($infoUser->fullname); ?></h5>
                <h6><?= $infoCity; ?></h6>
              </div>
              <div class="puntaje mr">
                <a type="button" class="btn-floating btn-xl btn-yt">
                  <h4><?= $infoPoint ?></h4>
                  <h5>PUNTOS</h5>
                </a>
              </div>
            </div>
          </div>
          <div class="resultados-interna">
          	<?php if($result) { ?>     	
	            <div class="resultado-interna-cuadro">
	            	<div class="resultado-interna-titulo">
		                <h5>FECHA</h5>
		            </div>
	            	   <?php for ($i=0; $i < count($result); $i++) { ?>
	            	   	<div class="resultado-interna-caja">
	            	   		<?php $date = date_create($result[$i]['fecha']); ?>
                            <?= date_format($date,"M j Y ")  ?>
	              		</div>
	            	   <?php } ?>
	            </div>

	        <div class="resultado-interna-cuadro">
              <div class="resultado-interna-titulo">
                <h5>PUNTOS</h5>
              </div>
              <?php for ($i=0; $i < count($result); $i++) { ?>
	            	<div class="resultado-interna-caja">
	                	+ <?= $result[$i]['point'] ?>
	              	</div>
	          <?php } ?>
            </div>
            <div class="resultado-interna-cuadro">
              <div class="resultado-interna-titulo">
                <h5>CÓDIGO</h5>
              </div>
              <?php for ($i=0; $i < count($result); $i++) { ?>
	            	<div class="resultado-interna-caja">
	                	 <?= $result[$i]['cod'] ?>
	              	</div>
	          <?php } ?>
            </div>
	           
            <?php } else { ?>
            <div class="resultado-interna-cuadro">
              <div class="resultado-interna-titulo">
                <h5>FECHA</h5>
              </div>
              <div class="resultado-interna-caja">                 
              </div>
            </div>
            <div class="resultado-interna-cuadro">
              <div class="resultado-interna-titulo">
                <h5>PUNTOS</h5>
              </div>
              <div class="resultado-interna-caja">
              </div>
            </div>
            <div class="resultado-interna-cuadro">
              <div class="resultado-interna-titulo">
                <h5>CÓDIGO</h5>
              </div>
              <div class="resultado-interna-caja">
                  
              </div>
            </div>
            <?php } ?>
          </div>
          <div class="btn-vermas">

            <img src=<?= Yii::getAlias('@web').'/img/btn-vermas.png' ?> alt="">
          </div>  
        </div>
      </div>
      <!-- / Contenido-->
      <!-- Footer -->
      <?php echo $this->render('_footer'); ?>
      <!-- Footer -->