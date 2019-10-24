<?php 
use yii\helpers\Html;

?>
<div class="background-cover">
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
                  <span><?=  Yii::$app->user->identity->username;?></span>
                </a>
              </div>
            </li>
            <!--/. Logo -->
            <!-- Side navigation menus -->
            <li>
              <ul class="collapsible collapsible-accordion">
                <li>
                  <a class="waves-effect">
                    <i class="fas fa-user-circle"></i>Perfil
                  </a>
                </li>
                <li>
                  <a class="waves-effect">
                    <i class="fas fa-medal"></i>Campaña
                  </a>
                </li>
                <li>
                  <a class="waves-effect">
                    <i class="fas fa-user-friends"></i>Usuarios
                  </a>
                </li>
                <li>
                  <a class="waves-effect">
                    <i class="fas fa-headset"></i>Contactar
                  </a>
                </li>
                <li>
                  <a class="waves-effect">
                    <i class="fas fa-clipboard-list"></i>Estaciones
                  </a>
                </li>
                <li data-activates="slide-out" class="button-collapse2">
                  <a class="waves-effect" >
                    <i class="far fa-times-circle"></i>Cerrar
                  </a>
                </li>
              </ul>
            </li>
            <!--/. Side navigation Menus-->
          </ul>
          <div class="sidenav-bg"></div>
        </div>
        <!--/. Header -->
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
          <!-- SideNav slide-out button -->
          <div class="float-left">
            <a data-activates="slide-out" class="button-collapse"><i class="fas fa-bars"></i></a>
          </div>
          <!-- logo nav-->
          <div class="breadcrumb-dn">
            <p>
              <img src=<?= Yii::getAlias('@web')."/img/logo.png" ?> alt="">
            </p>
          </div>
          <!--/.Logo nav-->
          <ul class="navbar-nav ml-auto nav-flex-icons">
            <li class="nav-item avatar">
              <a class="nav-link p-0" href="#">
                <img src=<?= Yii::getAlias('@web')."/img/avatar.jpg" ?> class="rounded-circle z-depth-0" alt="avatar image" height="35">
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.Navbar -->
      </header>
      <!--/.Double navigation-->
      <!-- Contenido-->
      <div class="container">
        <div class="perfil">
          <figure>
            <img src=<?= Yii::getAlias('@web')."/img/avatar-banner.png" ?> alt="">
          </figure>
          <h4><?=  Yii::$app->user->identity->username;?></h4>
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
      <footer class="page-footer">
        <div class="text-center py-3">
          <img src=<?= Yii::getAlias('@web')."/img/logo-footer.png" ?> alt="">
        </div>
      </footer>
      <!-- Footer -->
    </div>