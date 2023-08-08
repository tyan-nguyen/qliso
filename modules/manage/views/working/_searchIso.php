<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\web\JsExpression;
use app\modules\admin\models\RoomParent;
use app\modules\admin\models\Room;
use app\modules\manage\models\Examination;
?>
<div id="pn-search" class="panel"> 
<div class="panel-heading"> 
	<h3 class="panel-title pull-left" onclick="$('#pn-search .panel-body').toggle()"><i class="glyphicon glyphicon-search"></i> Tìm kiếm 	</h3>
	<!-- <h3 class="panel-title pull-left" onclick="$('#frm-search').submit()"><i class="glyphicon glyphicon-search"></i> Tìm kiếm 	</h3> -->
	<span class="sLoading pull-left" style="display:none"><?= Html::img(Yii::getAlias('@web').'/images/loading.gif') ?></span>
	
</div> 
<div class="panel-body">

<?php $form = ActiveForm::begin([
        'action' => ['index-iso' . $curlink],
      'method' => 'get',
      'id'=>'frm-search',
      'options' => ['data-pjax' => true ]
  ]); ?>

    <div class="row r-first">
    	
    	<div class="col-md-3">
  			<?= $form->field($searchModel, 'code')->textInput()  ?>
  		</div>
  		<div class="col-md-3">
  			<?= $form->field($searchModel, 'date_exam')->textInput()  ?>
  		</div>
  		
  		<!-- <div class="col-md-2">
              <?= $form->field($searchModel, 'id_examination')->widget(Select2::classname(), [
              		'data' => (new Examination())->getListbyIso($idiso),
                    'options' => ['placeholder' => 'Chọn ISO ...'],
                    'attribute' => 'id_examination',
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ])->label('Iso'); ?>
            </div> -->
    	
    	<div class="col-md-3">
    		<?php 
    			/* if($searchModel->id_room != null){
    				$room = Room::findOne($searchModel->id_room);
    				$searchModel->idRoomParent = $room->room_parent;
    			} */
    		?>
              <?= $form->field($searchModel, 'idRoomParent')->widget(Select2::classname(), [
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
                            $('#id_room').html(response);
                          })
                        }
                        else {
                          $('#id_room').html('');
                        }
                      }"
                    ]
                ])->label('Khoa'); ?>
            </div>
            <div class="col-md-3">
            	<?php 
            		$data = array();
	            	if($searchModel->idRoomParent != null){
	            		$data = (new Room())->getListByParent($searchModel->idRoomParent);
	    			} 
    			?>
              <?= $form->field($searchModel, 'id_room')->widget(Select2::classname(), [
                    'data' => $data,
                    'options' => ['id'=>'id_room','placeholder' => 'Chọn phòng/bộ môn ...'],
                    'attribute' => 'id_room',
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ]); ?>
            </div>
    	
	    <!-- <div class="col-md-2">
	    	<label></label>
	    	<p>
	    		<span class="glyphicon glyphicon-remove" style="cursor: pointer;color:red;" onclick="clearSearch()"></span> Xóa tìm kiếm
	    	</p>
	    </div> -->
    </div>

</div>


<?php ActiveForm::end(); ?>
</div>