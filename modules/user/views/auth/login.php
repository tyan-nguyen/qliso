<?php
/**
 * @var $this yii\web\View
 * @var $model webvimark\modules\UserManagement\models\forms\LoginForm
 */

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

//$setting = SSetting::findOne(1);
?>

<style>
.error-summary{
	background: #f7e2c0;
	text-align:left;
	padding:10px;
	margin-bottom:20px;
}
.error-summary ul li{
	list-style-type: circle;
}
h1{
	color:#f7a41e;
	font-size:20px;
}
</style>
        <?php $form = ActiveForm::begin([
						'id'      => 'login-form',
						//'options'=>['autocomplete'=>'off'],
						//'validateOnBlur'=>true,
						'fieldConfig' => [
							//'template'=>"{input}\n{error}",
							'template'=>"{input}",
						],
					]) ?>

					<?= $form->errorSummary($model); ?>
				
				<?php  ?>
				<div class="form-group has-feedback">
				<?= $form->field($model, 'username')
					->textInput(['placeholder'=>'Tài khoản', 'autocomplete'=>'off', 'required'=>true,
							'oninvalid'=>"this.setCustomValidity('Vui lòng nhập tài khoản hợp lệ')",
							'oninput'=>"this.setCustomValidity('')"
				]) ?>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      			</div>
				
				<div class="form-group has-feedback">
				<?= $form->field($model, 'password')
					->passwordInput(['placeholder'=>$model->getAttributeLabel('password'), 'autocomplete'=>'off',
							'required'=>true, 'oninvalid'=>"this.setCustomValidity('Vui lòng nhập Mật khẩu')",
							'oninput'=>"this.setCustomValidity('')"
				]) ?>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
      			</div>
      			
      			<div class="row">
		        <div class="col-xs-8">
		          <div class="checkbox icheck">
		            <label>
		              <input type="checkbox"> Ghi nhớ đăng nhập
		            </label>
		          </div>
		        </div>
		        <!-- /.col -->
		        <div class="col-xs-4">
		          <button type="submit" class="btn btn-primary btn-block btn-flat">LOGIN</button>
		        </div>
		        </div>
		        <!-- /.col -->

				<?php /* Html::submitButton(
					UserManagementModule::t('front', '<i class="fa fa-unlock-alt" aria-hidden="true"></i> ĐĂNG NHẬP'),
					['class' => 'btn btn-warning btn-lg', 'style'=>'margin-top:10px;']
				) */ ?>
				<?php  ?>
				
			<?php /*?><div class="form-group has-feedback">
        <input name="LoginForm[username]" type="email" class="form-control" placeholder="Email" required  oninvalid="this.setCustomValidity('Vui lòng nhập Email hợp lệ')" oninput="this.setCustomValidity('')">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="LoginForm[password]" type="password" class="form-control" placeholder="Mật khẩu" required  oninvalid="this.setCustomValidity('Vui lòng nhập Mật khẩu')" oninput="this.setCustomValidity('')">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Ghi nhớ đăng nhập
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">LOGIN</button>
        </div>
        <!-- /.col -->
      </div> <?php */ ?>

		<?php ActiveForm::end() ?>