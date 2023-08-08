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
class LoginAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
			'assets/AdminLTE-2.4.12/bower_components/bootstrap/dist/css/bootstrap.min.css',
			'assets/AdminLTE-2.4.12/bower_components/font-awesome/css/font-awesome.min.css',
			'assets/AdminLTE-2.4.12/bower_components/Ionicons/css/ionicons.min.css',
			'assets/AdminLTE-2.4.12/dist/css/AdminLTE.min.css',
			'assets/AdminLTE-2.4.12/plugins/iCheck/square/blue.css',
	];
	public $js = [
			['assets/AdminLTE-2.4.12/bower_components/jquery/dist/jquery.min.js', 'position' => \yii\web\View::POS_HEAD],
			['assets/AdminLTE-2.4.12/bower_components/bootstrap/dist/js/bootstrap.min.js', 'position' => \yii\web\View::POS_HEAD],
			'assets/AdminLTE-2.4.12/plugins/iCheck/icheck.min.js',
			'assets/js/checkbox.js',
	];
	public $depends = [
			'yii\web\YiiAsset',
			'yii\bootstrap\BootstrapAsset',
	];
}
