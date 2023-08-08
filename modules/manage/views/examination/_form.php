<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\modules\manage\models\Iso;

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\Examination */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="examination-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'id_iso')->widget(Select2::classname(), [
          		'data' => (new Iso())->getList(),
                'options' => ['placeholder' => 'Chọn ISO ...'],
                'attribute' => 'id_iso',
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
