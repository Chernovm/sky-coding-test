<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Registration page form interaction asset bundle
 */
class RegistrationAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        "js/registration.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
