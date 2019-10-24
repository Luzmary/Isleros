<?php 
use yii\helpers\Html;

?>

      <header>
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg double-nav no-padding2">
          <!-- SideNav slide-out button -->
          <div class="float-left botton-bar">
            <?= Html::a(Html::tag('i','',['class'=>"fas fa-undo"]), ['user/islero'],['class'=>'botton-collapse']); ?>

          </div>
          <!-- logo nav-->
          <div class="breadcrumb-dn">
            <p>
                <img src=<?= Yii::getAlias('@web')."/img/logo.png" ?> alt="">
            </p>
          </div>
        </nav>
        <!-- /.Navbar -->
      </header>