<?php

use yii\helpers\Html;

?>

<!--Header-->
    <header>
      <!-- Sidebar navigation -->
      <div id="slide-out" class="side-nav fixed wide">
        <ul class="custom-scrollbar">
          <!-- Logo -->
          <li>
            <div class="logo-wrapper sn-ad-avatar-wrapper">
              <a href="#">
                <img src=<?= Yii::getAlias('@web').'/img/avatar-perfil.jpg' ?> class="rounded-circle">
                <span><?=  strtoupper(Yii::$app->user->identity->fullname); ?></span>
              </a>
            </div>
          </li>
          <!--/. Logo -->
          <!-- Nav menu-->
          <li>
            <ul class="collapsible collapsible-accordion">
              <li>
                <a class="waves-effect">
                  <i class="fas fa-user-circle"></i>Perfil
                </a>
              </li>
              <li>
                <a class="waves-effect">
                  <i class="fas fa-headset"></i>Contactar
                </a>
              </li>
              <li>
                  <?= Html::a(Html::tag('i', '', ['class' => 'fas fa-clipboard-list']). 'Estaciones', ['admin/estacion'],[['class' => 'waves-effect']]) ?>
              </li>
              <li data-activates="slide-out" class="button-collapse2">
                  <?= Html::a(Html::tag('i', '', ['class' => 'far fa-times-circle']). 'Cerrar', ['site/logout'],['data' => ['method' => 'post']]); ?>
                </li>

            </ul>
          </li>
          <!--/. Nav menu-->
        </ul>
        <div class="sidenav-bg"></div>
      </div>
      <!--/. Header -->
      <!-- Navbar -->
        <?php echo $this->render('_navbar'); ?>
      <!-- /.Navbar -->
    </header>
