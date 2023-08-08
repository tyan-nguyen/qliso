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
class QrAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
			//'assets/css/kv-mpdf-bootstrap.min.css',
			//'assets/AdminLTE-2.4.12/dist/css/AdminLTE.min.css',
			'assets/css/mpdf.css',
			//'assets/css/custom.css',
	];
	public $js = [

	];
	/* public $depends = [
			'yii\web\YiiAsset',
			'yii\bootstrap\BootstrapAsset',
	]; */
}
