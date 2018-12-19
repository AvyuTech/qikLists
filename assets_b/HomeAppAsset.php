<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets_b;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HomeAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'home_assets/bootsnav-master/css/bootsnav.css',
        'home_assets/themify-icons/themify-icons.css',
        'home_assets/font-awesome/css/font-awesome.min.css',
        'home_assets/bootsnav-master/css/animate.css',
        'home_assets/magnific-popup/magnific-popup.css',
        'home_assets/vegas/vegas.css',
        'css/style.css',
        'css/color_04_custom.css',
    ];
    public $js = [
        'js/modernizr-custom.js',
        'home_assets/bootsnav-master/js/bootsnav.js',
        'home_assets/paraxify/paraxify.min.js',
        'home_assets/magnific-popup/jquery.magnific-popup.min.js',
        'home_assets/vegas/vegas.min.js',
        'home_assets/vide/jquery.vide.min.js',
        'https://cdn.webrtc-experiment.com/RecordRTC.js',
        'https://cdn.webrtc-experiment.com/gif-recorder.js',
        'https://cdn.webrtc-experiment.com/getScreenId.js',
        'https://cdn.webrtc-experiment.com/gumadapter.js',
        'js/custom.js',
    ];

    /*public $jsOptions = [
        'position' => \yii\web\View::POS_END
    ];*/

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
