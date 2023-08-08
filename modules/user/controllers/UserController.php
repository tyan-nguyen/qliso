<?php

namespace app\modules\user\controllers;

use webvimark\components\AdminDefaultController;
use Yii;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\models\search\UserSearch;
use yii\web\NotFoundHttpException;
use app\modules\user\models\UserProfile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends AdminDefaultController
{
	/**
	 * @var User
	 */
	public $modelClass = 'webvimark\modules\UserManagement\models\User';

	/**
	 * @var UserSearch
	 */
	public $modelSearchClass = 'webvimark\modules\UserManagement\models\search\UserSearch';

	/**
	 * @return mixed|string|\yii\web\Response
	 */
	public function actionCreate()
	{
		$model = new User(['scenario'=>'newUser']);
		$profile = new UserProfile();

		if ( $model->load(Yii::$app->request->post()) && $model->save() )
		{
			$profile->load(Yii::$app->request->post());
			$profile->id = $model->id;
			$profile->save();
			return $this->redirect(['view',	'id' => $model->id]);
		}

		return $this->renderIsAjax('create', ['model'=>$model, 'profile'=>$profile]);
	}
	
	/**
	 * @return mixed|string|\yii\web\Response
	 */
	public function actionUpdate($id)
	{
		//$model = new User(['scenario'=>'newUser']);
		$model = User::findOne($id);
		
		if ( !$model )
		{
			throw new NotFoundHttpException('User not found');
		}
		
	//	$model->scenario = 'changePassword';
		
		$profile = UserProfile::findOne($id);
		
		if ( $model->load(Yii::$app->request->post()) && $model->save() )
		{
			$profile->load(Yii::$app->request->post());
			$profile->save();
			return $this->redirect(['view',	'id' => $model->id]);
		}
		
		return $this->renderIsAjax('update', ['model'=>$model, 'profile'=>$profile]);
	}

	/**
	 * @param int $id User ID
	 *
	 * @throws \yii\web\NotFoundHttpException
	 * @return string
	 */
	public function actionChangePassword($id)
	{
		$model = User::findOne($id);

		if ( !$model )
		{
			throw new NotFoundHttpException('User not found');
		}

		$model->scenario = 'changePassword';

		if ( $model->load(Yii::$app->request->post()) && $model->save() )
		{
			return $this->redirect(['view',	'id' => $model->id]);
		}

		return $this->renderIsAjax('changePassword', compact('model'));
	}

}
