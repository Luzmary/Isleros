<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/mdb.min.css',
        'css/style.css'
    ];
    public $js = [
        "js/popper.min.js",
        "js/bootstrap.min.js",
        "js/mdb.min.js",
        "js/main.js",

    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
