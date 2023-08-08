<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\modules\manage\models\TeamPostion;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\TeamMember */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="team-member-form">

    <?php $form = ActiveForm::begin(); ?>
    
     <?= $form->field($model, 'id_position')->widget(Select2::classname(), [
                    'data' => (new TeamPostion())->getList(),
                    'options' => ['id'=>'id_position','placeholder' => 'Chọn chức vụ...'],
                    'attribute' => 'id_position',
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ]); ?>

    <?= $form->field($model, 'id_user')->widget(Select2::classname(), [
                    'data' => (new User())->getListLong(),
                    'options' => ['id'=>'id_user','placeholder' => 'Chọn tài khoản...'],
                    'attribute' => 'id_user',
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ]); ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<script>
$.fn.modal.Constructor.prototype.enforceFocus = function() {};
</script>
