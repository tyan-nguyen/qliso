<?php

use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;
use app\modules\admin\models\Branch;
use app\modules\admin\models\Room;
use kartik\select2\Select2;
use app\modules\admin\models\RoomParent;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 * @var yii\bootstrap\ActiveForm $form
 */
?>

<div class="user-form">

	<?php $form = ActiveForm::begin([
		'id'=>'user',
		'layout'=>'horizontal',
		'validateOnBlur' => false,
	]); ?>

	<?= $form->field($model->loadDefaultValues(), 'status')
		->dropDownList(User::getStatusList()) ?>

	<?= $form->field($model, 'username')->textInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>

	<?php if ( $model->isNewRecord ): ?>

		<?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>

		<?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>
	<?php endif; ?>


	<?php if ( User::hasPermission('bindUserToIp') ): ?>

		<?= $form->field($model, 'bind_to_ip')
			->textInput(['maxlength' => 255])
			->hint(UserManagementModule::t('back','For example: 123.34.56.78, 168.111.192.12')) ?>

	<?php endif; ?>

	<?php if ( User::hasPermission('editUserEmail') ): ?>

		<?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
		<?= $form->field($model, 'email_confirmed')->checkbox() ?>

	<?php endif; ?>
	
	
	<?= $form->field($profile, 'name')->textInput(['maxlength' => 255]) ?>
	
	<?= $form->field($profile, 'phone')->textInput(['maxlength' => 255]) ?>
	
	<?= $form->field($profile, 'address')->textInput(['maxlength' => 255]) ?>
	
	<?= $form->field($profile, 'position')->textInput(['maxlength' => 255]) ?>
	
	<?php /* $form->field($profile,'room_id')->dropDownList((new Room())->getList(),
					['class'=>'form-control', 'prompt'=>'--Chọn--']) */ ?>
					
		<?php 
		if($profile->room_id != null){
		    $room = Room::findOne($profile->room_id);
		    $profile->idRoomParent = $room->room_parent;
		}
		?>
          <?= $form->field($profile, 'idRoomParent')->widget(Select2::classname(), [
          		'data' => (new RoomParent())->getList(),
                'options' => ['placeholder' => 'Chọn khoa ...'],
                'attribute' => 'idRoomParent',
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'pluginEvents' => [
                  "change" => "function(event) {
                    console.log(event.target.value);
                    if(event.target.value)
                    {
                      $.post('".Yii::getAlias('@web')."/manage/select/get-list-room-by-parent?parent='+event.target.value,function(response){
                        $('#id_room_frm').html(response);
                      })
                    }
                    else {
                      $('#id_room_frm').html('');
                    }
                  }"
                ]
            ]); ?>
            
            
            <?php 
        		$data = array();
        		if($profile->idRoomParent != null){
        		    $data = (new Room())->getListByParent($profile->idRoomParent);
    			} 
			?>
          <?= $form->field($profile, 'room_id')->widget(Select2::classname(), [
                'data' => $data,
                'options' => ['id'=>'id_room_frm','placeholder' => 'Chọn phòng/bộ môn ...'],
                'attribute' => 'room_id',
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]); ?>
	
	


	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<?php if ( $model->isNewRecord ): ?>
				<?= Html::submitButton(
					'<span class="glyphicon glyphicon-plus-sign"></span> ' . UserManagementModule::t('back', 'Create'),
					['class' => 'btn btn-success']
				) ?>
			<?php else: ?>
				<?= Html::submitButton(
					'<span class="glyphicon glyphicon-ok"></span> ' . UserManagementModule::t('back', 'Save'),
					['class' => 'btn btn-primary']
				) ?>
			<?php endif; ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>

</div>

<?php BootstrapSwitch::widget() ?>