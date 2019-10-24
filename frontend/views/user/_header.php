<?php

use yii\helpers\Html;

?>

<header>
        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav fixed wide">
          <ul class="custom-scrollbar">
            <!-- Logo -->
            <li>
              <div class="logo-wrapper sn-ad-avatar-wrapper">
                <?php 
                   if(Yii::$app->user->identity->avatar) {
                        $img_url =  Yii::$app->user->identity->avatar;
                   } else {
                       $img_url = "img/avatar-cuenta.png";
                   }

                ?>
                <a href="#">
                  <img src=<?= Yii::getAlias('@web').'/'.$img_url;?> class="rounded-circle">
                  <span><?=  Yii::$app->user->identity->fullname;?></span>
                </a>
              </div>
            </li>
            <!--/. Logo -->
            <!-- Side navigation menus -->
            <li>
              <ul class="collapsible collapsible-accordion">
                <li>
                  <?= Html::a(Html::tag('i', '', ['class' => 'fas fa-user-circle']). 'Perfil', ['user/update','id'=>Yii::$app->user->identity->id],[['class' => 'waves-effect']]) ?>
                </li>
                <li>
                  <?= Html::a(Html::tag('i', '', ['class' => 'fas fa-medal']). 'Tus Codigos', ['user/codigo'],[['class' => 'waves-effect']]) ?>
                </li>
                <li>
                  <?= Html::a(Html::tag('i', '', ['class' => 'fas fa-user-friends']). 'Redimir Puntos', ['user/redencion'],[['class' => 'waves-effect']]) ?>
                </li>
                <li>
                    <?= Html::a(Html::tag('i', '', ['class' => 'fas fa-headset']). 'Contactar', ['site/contact'],[['class' => 'waves-effect']]) ?>
                </li>

                <li data-activates="slide-out" class="button-collapse2">
                  <?= Html::a(Html::tag('i', '', ['class' => 'far fa-times-circle']). 'Cerrar', ['site/logout'],['data' => ['method' => 'post']]); ?>
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
              <?php 
                   if(Yii::$app->user->identity->avatar) {
                        $img_url =  Yii::$app->user->identity->avatar;
                   } else {
                       $img_url = "img/avatar.jpg";
                   }

                ?>
              <a class="nav-link p-0" href="#">
                <img src=<?= Yii::getAlias('@web').'/'.$img_url; ?> class="rounded-circle z-depth-0" alt="avatar image" height="35" width="35">
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.Navbar -->
</header>
