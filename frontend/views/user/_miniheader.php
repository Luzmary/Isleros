<?php 
use yii\helpers\Html;

?>

    <header>
        <!-- Navbar -->
        <nav class="navbar  navbar-toggleable-md navbar-expand-lg double-nav no-padding2" style="padding: 0;">
          <!-- SideNav slide-out button -->
          <div class="bar-logos" style="width: 10%; color: #f8d426;  color: black; background: none;">
            <?= Html::a(Html::tag('i','',['class'=>"fas fa-undo"]), ['user/islero']); ?>

          </div>
          <!-- logo nav-->
          <div class="bar-logos" style="background: #fff100;">
              <img src=<?= Yii::getAlias('@web')."/img/simoniz.png" ?> alt="">
          </div>
          <div class="bar-logos" style="background: #e1251b;">
              <img src=<?= Yii::getAlias('@web')."/img/logo.png" ?> alt="">
          </div>
          <div class="bar-logos"  style="background: #b21e1b;">
              <img src=<?= Yii::getAlias('@web')."/img/logo-islero.png" ?> alt="">
          </div>
          <!--/.Logo nav-->
        </nav>
        <!-- /.Navbar -->
    </header>