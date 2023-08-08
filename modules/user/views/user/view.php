<?php

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\models\rbacDB\Role;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\user\models\UserProfile;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 */

$this->title = 'Tài khoản ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => UserManagementModule::t('back', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

	<div class="panel panel-default">
		<div class="panel-body">

		    <p>
			<?= GhostHtml::a(UserManagementModule::t('back', 'Cập nhật'), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
			<?= GhostHtml::a(UserManagementModule::t('back', 'Thêm mới'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
			<?= GhostHtml::a(
				UserManagementModule::t('back', 'Phân quyền'),
				['/user/user-permission/set', 'id'=>$model->id],
				['class' => 'btn btn-sm btn-default']
			) ?>

			<?= GhostHtml::a(UserManagementModule::t('back', 'Xóa tài khoản'), ['delete', 'id' => $model->id], [
			    'class' => 'btn btn-sm btn-danger pull-right',
			    'data' => [
				'confirm' => UserManagementModule::t('back', 'Bạn có chắc muốn xóa tài khoản này?'),
				'method' => 'post',
			    ],
			]) ?>
		    </p>

			<?= DetailView::widget([
				'model'      => $model,
				'attributes' => [
					'id',
					[
						'attribute'=>'status',
						'value'=>User::getStatusValue($model->status),
					],
					'username',
					[
						'attribute'=>'email',
						'value'=>$model->email,
						'format'=>'email',
						'visible'=>User::hasPermission('viewUserEmail'),
					],
					[
						'attribute'=>'email_confirmed',
						'value'=>$model->email_confirmed,
						'format'=>'boolean',
						'visible'=>User::hasPermission('viewUserEmail'),
					],
					[
						'label'=>UserManagementModule::t('back', 'Roles'),
						'value'=>implode('<br>', ArrayHelper::map(Role::getUserRoles($model->id), 'name', 'description')),
						'visible'=>User::hasPermission('viewUserRoles'),
						'format'=>'raw',
					],
					[
						'attribute'=>'bind_to_ip',
						'visible'=>User::hasPermission('bindUserToIp'),
					],
					array(
						'attribute'=>'registration_ip',
						'value'=>Html::a($model->registration_ip, "http://ipinfo.io/" . $model->registration_ip, ["target"=>"_blank"]),
						'format'=>'raw',
						'visible'=>User::hasPermission('viewRegistrationIp'),
					),
					'created_at:datetime',
					'updated_at:datetime',
				],
			]) ?>
			
			<?php 
			 $modelProfile = UserProfile::findOne($model->id);
			?>
			
			<?= DetailView::widget([
				'model'      => $modelProfile,
				'attributes' => [
					//'id',
					'name',		
				    'phone',
				    'address',
				    'position',
				    [
				        'attribute'=>'room_id',
				        'value'=>$modelProfile->room->room_name,
				    ],
				],
			]) ?>

		</div>
	</div>
</div>
