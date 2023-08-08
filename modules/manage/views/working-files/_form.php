<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\WorkingFiles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="working-files-form">

    <?php $form = ActiveForm::begin([
    		'id' => 'frm-file',
    		'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?php // $form->field($model, 'id_working')->textInput() ?>

    <?php // $form->field($model, 'id_user')->textInput() ?>

    <?php // $form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'file_url')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'shared_with')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'file')->fileInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
