<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\modules\admin\models\Room;
//use dosamigos\datepicker\DatePicker;
use kartik\date\DatePicker;
use app\models\Custom;
use app\modules\manage\models\Template;

use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use app\modules\admin\models\RoomParent;
CrudAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\Working */
/* @var $form yii\widgets\ActiveForm */

if($model->date_exam != null){
    $custom = new Custom();
    $model->date_exam = $custom->convertYMDtoDMY($model->date_exam);
}

?>



<div class="working-form row">

<div class="col-md-12">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model) ?>

    <?php // $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'id_examination')->textInput() ?>

    <?php /*$form->field($model, 'id_room')->widget(Select2::classname(), [
                    'data' => (new Room())->getList(),
                    'options' => ['id'=>'id_room_frm','placeholder' => 'Chọn phòng/bộ môn ...'],
                    'attribute' => 'id_room',
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ]); */ ?>
                
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
            ])->label('Khoa'); ?>
            
            
            <?php 
        		$data = array();
            	if($model->idRoomParent != null){
            		$data = (new Room())->getListByParent($model->idRoomParent);
    			} 
			?>
          <?= $form->field($model, 'id_room')->widget(Select2::classname(), [
                'data' => $data,
                'options' => ['id'=>'id_room_frm','placeholder' => 'Chọn phòng/bộ môn ...'],
                'attribute' => 'id_room',
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]); ?>
    
    <?php
        echo $form->field($model, 'date_exam')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Chọn ngày kiểm tra...'],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd/mm/yyyy'
            ]
        ]);
    ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>
    
     <?= $form->field($model, 'id_template_group')->widget(Select2::classname(), [
                    'data' => (new Template())->getList(),
                    'options' => ['id'=>'id_template_group','placeholder' => 'Chọn template...'],
                    'attribute' => 'id_template_group',
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ]); ?>
    
    <?= $form->field($model, 'id_template_single')->widget(Select2::classname(), [
                    'data' => (new Template())->getList(),
                    'options' => ['id'=>'id_template_single','placeholder' => 'Chọn template...'],
                    'attribute' => 'id_template_single',
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ]); ?>
	
    <?php ActiveForm::end(); ?>
    
      </div>
    
  
</div>

<script>
$.fn.modal.Constructor.prototype.enforceFocus = function() {};
</script>
