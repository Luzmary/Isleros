<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="background-amarillo">
  
      <!--Header-->
      <?php echo $this->render('../user/_miniheader'); ?>

      <!--/.Double navigation-->
      <!-- Banner-->
      <div class="banner-texto" style="background: #f2f2f2;">
          <a type="button" class="btn-floating btn-lg btn-yt"><i class="fas fa-headset"></i></a> 
          <h4>CONTACTO</h4>
      </div>
      <!-- Contenido-->
      <div class="contenido-contacto">
          <div class="modulo-contacto">
            <img src=<?= Yii::getAlias('@web').'/img/simoniz.png' ?> alt="">
            <h6>Bogotá - Colombia</h6>
          </div>
          <div class="modulo-contacto">
            <i class="fas fa-envelope-open-text"></i>
            <h6>soporte@simoniz.com</h6>
          </div>
          <div class="modulo-contacto">
            <i class="fas fa-phone"></i>
            <h6>(+57) 000 000 0000</h6>
            <h6>(+57 1) 000 0000</h6>
          </div>
      </div>
      <!-- Contenido-->
    </div>
