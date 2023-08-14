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
    		'assets/AdminLTE-2.4.12/bower_components/bootstrap/dist/css/bootstrap.min.css',
    		'assets/AdminLTE-2.4.12/bower_components/font-awesome/css/font-awesome.min.css',
    		'assets/AdminLTE-2.4.12/dist/css/AdminLTE.css',
    		'assets/AdminLTE-2.4.12/dist/css/skins/_all-skins.min.css',
    		//'assets/AdminLTE-2.4.12/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
    		//'assets/AdminLTE-2.4.12/bower_components/bootstrap-daterangepicker/daterangepicker.css',
    		'assets/AdminLTE-2.4.12/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
    		'assets/AdminLTE-2.4.12/plugins/iCheck/all.css',
    		'assets/js/datatable/datatables.min.css',
    		//'assets/AdminLTE-2.4.12/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css',
       		'assets/css/custom.css',
            'css/gridview-custom.css'
    ];
    public $js = [
    		['assets/AdminLTE-2.4.12/bower_components/jquery/dist/jquery.min.js', 'position' => \yii\web\View::POS_HEAD],
    		['assets/AdminLTE-2.4.12/bower_components/bootstrap/dist/js/bootstrap.min.js', 'position' => \yii\web\View::POS_HEAD],
    		'assets/AdminLTE-2.4.12/bower_components/jquery-ui/jquery-ui.min.js',
    		'assets/AdminLTE-2.4.12/bower_components/moment/min/moment.min.js',
    		'assets/AdminLTE-2.4.12/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
    		'assets/AdminLTE-2.4.12/dist/js/adminlte.min.js',
    		//'assets/AdminLTE-2.4.12/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js',
    		'assets/js/custom.js',
    		'assets/js/datatable/datatables.min.js'
    		//'assets/AdminLTE-2.4.12/dist/js/pages/dashboard.js',
    		//'js/jquery-number-master/jquery.number.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
