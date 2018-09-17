<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "public/css/bootstrap/min/bootstrap.min.css",
        "public/css/font-awesome/css/min/font-awesome.min.css",
        "public/css/clean-blog-min/clean-blog.min.css",
        //"public/css/clean-blog.css",
        "public/css/newCSS.css",
        "public/css/photos.css",
        "public/unitegallery/css/unite-gallery.css",
        "public/unitegallery/themes/default/ug-theme-default.css",
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
    public $js = [
        "public/js/jquery/min/jquery.min.js",
        "public/js/popper/min/popper.min.js",
        "public/js/bootstrap/min/bootstrap.min.js",
        "public/js/clean-blog-min/clean-blog.min.js",
        "public/js/maps/maps.js",
        "public/unitegallery/themes/tiles/ug-theme-tiles.js",
        "public/unitegallery/js/unitegallery.min.js",
        "public/unitegallery/themes/default/ug-theme-default.js",
        "public/js/nvk_scripts.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
