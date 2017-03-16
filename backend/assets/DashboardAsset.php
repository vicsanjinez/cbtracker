<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'bootstrap/css/bootstrap.min.css',
        'font-awesome-4.7.0/css/font-awesome.min.css',
        'ionicons-2.0.1/css/ionicons.min.css',
        'dist/css/AdminLTE.min.css',
          'dist/css/skins/_all-skins.min.css',
          'plugins/iCheck/flat/blue.css',
          'plugins/morris/morris.css',
          'plugins/jvectormap/jquery-jvectormap-1.2.2.css',
          'plugins/datepicker/datepicker3.css',
          'plugins/daterangepicker/daterangepicker.css',
          'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
    ];
    public $js = [
        'js/main.js',

        //visible para q funcine el menu superior
        //oculto para que funcione export excel
        //'bootstrap/js/bootstrap.min.js', 

        'js/raphael-min.js',
        'plugins/morris/morris.min.js',
        'plugins/sparkline/jquery.sparkline.min.js',
        'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        'plugins/knob/jquery.knob.js',
        'js/moment.min.js',
        'plugins/daterangepicker/daterangepicker.js',
        'plugins/datepicker/bootstrap-datepicker.js',
        'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'plugins/slimScroll/jquery.slimscroll.min.js',
        'plugins/fastclick/fastclick.js',
        
        //visible para que funcione ocultar la navigation bar
        'dist/js/app.min.js',

        //'dist/js/pages/dashboard.js',
        //'dist/js/demo.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
