<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\modules\manage\models\DocType;
use app\modules\manage\models\DocGroup;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\Docs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docs-form">

    <?php $form = ActiveForm::begin([
        'id' => 'frm-document',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>    
     
    <?= $form->field($model, 'id_type')->widget(Select2::classname(), [
          		'data' => (new DocType())->getList(),
                'options' => ['placeholder' => 'Chọn loại tài liệu ...'],
                'attribute' => 'id_type',
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]); ?>
    
    <?= $form->field($model, 'id_group')->widget(Select2::classname(), [
          		'data' => (new DocGroup())->getList(),
                'options' => ['placeholder' => 'Chọn nhóm tài liệu ...'],
                'attribute' => 'id_group',
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]); ?>

    <?= $form->field($model, 'doc_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>
    
     <?= $form->field($model, 'file')->fileInput() ?>
     
      <?= $form->field($model, 'doc_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doc_summary')->textarea(['rows' => 6]) ?>

    <?php // $form->field($model, 'doc_date')->textInput() ?>
    
    <?php
        echo $form->field($model, 'doc_date')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Chọn ngày ký...'],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd/mm/yyyy'
            ]
        ]);
    ?>

    <?= $form->field($model, 'doc_sign')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
