<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\extensions;

use Yii;
use yii\helpers\Html;

/**
 * Modal renders a modal window that can be toggled by clicking on a button.
 *
 * The following example will show the content enclosed between the [[begin()]]
 * and [[end()]] calls within the modal window:
 *
 * ~~~php
 * Modal::begin([
 *     'header' => '<h2>Hello world</h2>',
 *     'toggleButton' => ['label' => 'click me'],
 * ]);
 *
 * echo 'Say hello...';
 *
 * Modal::end();
 * ~~~
 *
 * @see http://getbootstrap.com/javascript/#modals
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Modal extends \yii\bootstrap\Modal
{
	protected function initOptions()
	{
		$this->options = array_merge([
				'class' => 'fade',
				'role' => 'dialog',
				'tabindex' => '',
		], $this->options);
		Html::addCssClass($this->options, ['widget' => 'modal']);
		
		if ($this->clientOptions !== false) {
			$this->clientOptions = array_merge(['show' => false], $this->clientOptions);
		}
		
		if ($this->closeButton !== false) {
			$this->closeButton = array_merge([
					'data-dismiss' => 'modal',
					'aria-hidden' => 'true',
					'class' => 'close',
			], $this->closeButton);
		}
		
		if ($this->toggleButton !== false) {
			$this->toggleButton = array_merge([
					'data-toggle' => 'modal',
			], $this->toggleButton);
			if (!isset($this->toggleButton['data-target']) && !isset($this->toggleButton['href'])) {
				$this->toggleButton['data-target'] = '#' . $this->options['id'];
			}
		}
	}
}
