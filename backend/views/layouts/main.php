<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use backend\widgets\Alert;
use backend\widgets\Menu;

AppAsset::register($this);

//Register class
if (class_exists('ramosisw\CImaterial\web\MaterialAsset')) {
    ramosisw\CImaterial\web\MaterialAsset::register($this);
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
        <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>
<body>
<?php $this->beginBody() ?>

    <div class="wrapper">

        <div class="sidebar" data-color="orange" data-image="../img/sidebar-1.jpg">
            <!--
                Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

                Tip 2: you can also add an image using data-image tag
            -->

            <div class="logo">
                <?= Html::a(Html::img(Yii::getAlias('@web')."/img/logo2.png"), ['site/index']); ?>
            </div>

            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <?= Html::a(Html::tag('i', 'dashboard', ['class' => 'material-icons']). '<p>'.Yii::t('app', 'Dashboard').'</p>', ['site/index'],[['class' => '']]) ?>
                    </li>
                    <li>
                        <?= Html::a(Html::tag('i', 'person', ['class' => 'material-icons']). '<p>'.Yii::t('app', 'Usuarios').'</p>', ['user/index'],[['class' => '']]) ?>
                    </li>
                    <li>
                        <?= Html::a(Html::tag('i', 'input', ['class' => 'material-icons']). '<p>'.Yii::t('app', 'Registro Códigos').'</p>', ['register/index'],[['class' => '']]) ?>
                    </li>
                    <li>
                        <?= Html::a(Html::tag('i', 'branding_watermark', ['class' => 'material-icons']). '<p>'.Yii::t('app', 'Brand').'</p>', ['brand/index'],[['class' => '']]) ?>

                    </li>
                    <li>
                        <?= Html::a(Html::tag('i', 'code', ['class' => 'material-icons']). '<p>'.Yii::t('app', 'Códigos').'</p>', ['code/index'],[['class' => '']]) ?>
                    </li>
                    <li>
                        <?= Html::a(Html::tag('i', 'emoji_events', ['class' => 'material-icons']). '<p>'.Yii::t('app', 'Premios').'</p>', ['reward/index'],[['class' => '']]) ?>
                    </li>
                    <li>
                        <?= Html::a(Html::tag('i', 'emoji_flags', ['class' => 'material-icons']). '<p>'.Yii::t('app', 'Redenciones').'</p>', ['redencion/index'],[['class' => '']]) ?>
                    </li>
                    <li>
                        <?= Html::a(Html::tag('i', 'ev_station', ['class' => 'material-icons']). '<p>'.Yii::t('app', 'Estaciones').'</p>', ['station/index'],[['class' => '']]) ?>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">dashboard</i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                            <li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                   <i class="material-icons">person</i>
                                   <p class="hidden-lg hidden-md">Perfil</p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Perfil</a></li>
                                    <li>
                                        <?= Html::a(Yii::t('app', 'Sign out'), ['site/logout'],['data' => ['method' => 'post'], ['class' => 'btn btn-default btn-flat']]) ?>
                                    </li>
                                </ul>

                            </li>
                        </ul>

                        <form class="navbar-form navbar-right" role="search">
                            <div class="form-group  is-empty">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="material-input"></span>
                            </div>
                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons">search</i><div class="ripple-container"></div>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>

            <div class="content">

                        <?= Alert::widget() ?>
                        <?= $content ?>
            </div>

            <footer class="footer">
                    <p class="copyright pull-right">
                        &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                    </p>
                </div>
            </footer>
        </div>
    </div>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
