<?php

namespace app\modules\user;

/**
 * user module definition class
 */
class UserModule extends \yii\base\Module
{
	/**
	 * Options for registration and password recovery captcha
	 *
	 * @var array
	 */
	public $captchaOptions = [
			'class'     => 'yii\captcha\CaptchaAction',
			'minLength' => 3,
			'maxLength' => 4,
			'offset'    => 5
	];
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\user\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
