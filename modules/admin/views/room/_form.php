<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\RoomParent;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Room */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'room_parent')->dropDownList((new RoomParent())->getList(), ['prompt'=>'-Chọn-']) ?>

    <?= $form->field($model, 'room_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'room_name')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Lưu lại', ['class' => 'btn btn-lg btn-block btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
