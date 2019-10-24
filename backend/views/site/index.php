<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Simoniz';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Bienvenido!</h1>

        <p class="lead">Administración de la aplicación</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Usuario</h2>


                <p> <?= Html::a(Html::tag('i', 'person', ['class' => 'material-icons']). '<p>'.Yii::t('app', 'User Profile').'</p>', ['user/index'],[['class' => '']]) ?>
</p>
            </div>
            <div class="col-lg-4">
                <h2>Premios</h2>


                <p>                        <?= Html::a(Html::tag('i', 'emoji_events', ['class' => 'material-icons']). '<p>'.Yii::t('app', 'Premios').'</p>', ['reward/index'],[['class' => '']]) ?>
</p>
            </div>
            <div class="col-lg-4">
                <h2>Redenciones</h2>


                <p>                        <?= Html::a(Html::tag('i', 'emoji_flags', ['class' => 'material-icons']). '<p>'.Yii::t('app', 'Redenciones').'</p>', ['redencion/index'],[['class' => '']]) ?>
</p>
            </div>
        </div>

    </div>
</div>
