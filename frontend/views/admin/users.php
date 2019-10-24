<?php 
use yii\helpers\Html;
use common\models\User;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\helpers\Url;

$modelUser = new User();
?>

<?php Pjax::begin(); ?>
      <? Url::remember(['admin/home']); ?>
      <?php  echo $this->render('_miniheader',['idStation'=>$idStation]); ?>

      <!--/.Double navigation-->
      <!-- Contenido-->
      <div class="resultados">
        <div class="container">
          <div class="header-resultados">
            <div class="buscador">
         		<?php echo $this->render('_search', ['model' => $searchModel,'idStation'=>$idStation]); ?>
            </div>
          </div>
          	<div class="tabla-resultados">

	          	<? foreach ($dataProvider->models as $model) { ?>

	                 <div class="cuadro-resultados">
		              <div class="avatar-resultados">
		                <img src=<?= Yii::getAlias('@web').'/img/avatar-resultado.png' ?> alt="">
		              </div>
		              <div class="datos-resultados">
		                <h5><?=  strtoupper($model->fullname); ?></h5>
		                <h6><?= $modelUser->getUserCity($idStation,$model->id)?></h6>
		              </div>
		              <div class="puntaje">
		              	<?= Html::a(Html::tag('h4', $modelUser->getPointUser($idStation,$model->id).'<h5>PUNTOS</h5>'), ['admin/user-grilla'],['data'=>['method' => 'post','params'=>['idStation'=>$idStation,'idUser'=>$model->id]],'class' => 'btn-floating btn-lg btn-yt']) ?>		                
		              </div>
		            </div> 
	            <?php } ?>
        	</div>
			<div class="btn-vermas">
        		<?php echo LinkPager::widget(['pagination' => $pagination]); ?>
        	</div>
        </div>
      </div>
<?php Pjax::end(); ?>
      <!--/ Contenido-->
      <!-- Footer -->
            <?php echo $this->render('_footer'); ?>
      <!-- Footer -->