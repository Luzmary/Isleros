<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<header>
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg double-nav no-padding2">
          <!-- SideNav slide-out button -->
          <div class="float-left botton-bar">
            <? $url = Url::previous(); ?>
          	<?= Html::a(Html::tag('i','',['class'=>"fas fa-undo"]), $url,['data'=>['method' => 'post','params'=>['idStation'=>$idStation]],'class'=>'botton-collapse']); ?>

          </div>
          <!-- logo nav-->
          <div class="breadcrumb-dn">
            <p>
              <img src=<?= Yii::getAlias('@web').'/img/logo.png' ?> alt="">
            </p>
          </div>
          <!--/.Logo nav-->
          <ul class="navbar-nav ml-auto nav-flex-icons">
            <li class="nav-item avatar">
              <a class="nav-link p-0" href="#">
                <img src=<?= Yii::getAlias('@web').'/img/avatar.jpg' ?> class="rounded-circle z-depth-0" alt="avatar image" height="35">
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.Navbar -->
</header>