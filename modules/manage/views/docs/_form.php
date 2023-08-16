<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\modules\manage\models\DocType;
use app\modules\manage\models\DocGroup;
use kartik\date\DatePicker;
use app\modules\admin\models\Room;
use app\modules\admin\models\RoomParent;
use app\modules\manage\models\Dm;

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\Docs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docs-form">

    <?php $form = ActiveForm::begin([
        'id' => 'frm-document',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>    
    
    <div class="row">
    <div class="col-md-<?= $model->dm==null?'6':'12' ?>">
    <?= $form->field($model, 'id_type')->widget(Select2::classname(), [
          		'data' => (new DocType())->getList(),
                'options' => ['placeholder' => 'Chọn loại tài liệu ...'],
                'attribute' => 'id_type',
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]); ?>
    </div>
    <?php if ($model->dm == null):?>
    <div class="col-md-6">
    <?= $form->field($model, 'id_group')->widget(Select2::classname(), [
          		'data' => (new DocGroup())->getListByRoom(),
                'options' => ['placeholder' => 'Chọn nhóm tài liệu ...'],
                'attribute' => 'id_group',
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]); ?>
    </div>
    <?php endif; ?>
    
	</div>
	<div class="row">
    <div class="col-md-6">
	 <?= $form->field($model, 'doc_year')->widget(Select2::classname(), [
          		'data' => $model->getAvailableYear(),
                'options' => [/* 'placeholder' => 'Chọn nhóm tài liệu ...' */],
                'attribute' => 'doc_year',
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]); ?>
    </div>
     <div class="col-md-6">        
      <?= $form->field($model, 'doc_no')->textInput(['maxlength' => true]) ?>
      </div>
	</div>
	
	<?php if ($model->dm == null):?>
	<div class="row">
    <!-- <div class="col-md-6">
     <?php 
			if($model->id_room != null){
				$room = Room::findOne($model->id_room);
				$model->idRoomParent = $room->room_parent;
			}
		?>
          <?= $form->field($model, 'idRoomParent')->widget(Select2::classname(), [
          		'data' => (new RoomParent())->getList(),
                'options' => ['placeholder' => 'Chọn khoa ...'],
                'attribute' => 'idRoomParent',
                'pluginOptions' => [
                    'allowClear' => true,
                    'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
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
            ])->label('Khoa'); ?>
            
        </div> -->
     <div class="col-md-12">       
            <?php 
        		/* $data = array();
            	if($model->idRoomParent != null){
            		$data = (new Room())->getListByParent($model->idRoomParent);
    			}  */
			?>
          <?= $form->field($model, 'id_room')->widget(Select2::classname(), [
                //'data' => $data,
               'data'=>(new Room())->getList(),
                'options' => ['id'=>'id_room_frm','placeholder' => 'Chọn phòng/bộ môn ...'],
                'attribute' => 'id_room',
                'pluginOptions' => [
                    'allowClear' => true,
                    'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                ]
            ]); ?>
     </div>
	</div>
	<?php endif; ?>
	
	<div class="row">
    <div class="col-md-6">
	<?php
        echo $form->field($model, 'doc_date')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Chọn ngày ký...'],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd/mm/yyyy'
            ]
        ]);
    ?>
	</div>
     <div class="col-md-6">    
    <?= $form->field($model, 'doc_sign')->textInput(['maxlength' => true]) ?>
    </div>
    </div>
    
	<div class="row">
    <div class="col-md-12">
     <?= $form->field($model, 'doc_summary')->textarea(['rows' => 3]) ?>
	 </div>
	 <!-- <div class="col-md-6">
       <?= $form->field($model, 'id_dm')->widget(Select2::classname(), [
           'data' => (new Dm())->getList(),
                'options' => ['id'=>'id_dm_frm','placeholder' => 'Chọn danh mục ...'],
                'attribute' => 'id_dm',
                'pluginOptions' => [
                    'allowClear' => true,
                    'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                ]
            ]); ?>
	 </div> -->
	</div>  
    <?php // $form->field($model, 'doc_date')->textInput() ?>
    
    
    <div class="row">
    <div class="col-md-6">
     <?= $form->field($model, 'file')->fileInput() ?>
     </div>
     <div class="col-md-6"> 
     <?= $form->field($model, 'doc_url')->textInput(['maxlength' => true]) ?>
	</div>
	</div>
	
	<div class="row">
    <div class="col-md-12">
    <?= $form->field($model, 'summary')->textarea(['rows' => 3]) ?>
    </div>
    </div>
    
    
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
