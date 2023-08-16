<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\web\JsExpression;
use app\modules\admin\models\RoomParent;
use app\modules\admin\models\Room;
use app\modules\manage\models\DocType;
use app\modules\manage\models\DocGroup;
use kartik\date\DatePicker;
?>
<div id="pn-search" class="panel"> 
<div class="panel-heading"> 
	<h3 class="panel-title pull-left" onclick="$('#pn-search .panel-body').toggle()"><i class="glyphicon glyphicon-search"></i> Tìm kiếm 	</h3>
	<!-- <h3 class="panel-title pull-left" onclick="$('#frm-search').submit()"><i class="glyphicon glyphicon-search"></i> Tìm kiếm 	</h3> -->
	<span class="sLoading pull-left" style="display:none"><?= Html::img(Yii::getAlias('@web').'/images/loading.gif') ?></span>
	
</div> 
<div class="panel-body">

<?php $form = ActiveForm::begin([
      'method' => 'get',
      'id'=>'frm-search',
      'options' => ['data-pjax' => true ]
  ]); ?>

    <div class="row r-first">
    
    <!-- <div class="col-md-2"> -->
    		<?php 
    			/* if($searchModel->id_room != null){
    				$room = Room::findOne($searchModel->id_room);
    				$searchModel->idRoomParent = $room->room_parent;
    			} */
    		?>
             <?php /* $form->field($searchModel, 'idRoomParent')->widget(Select2::classname(), [
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
                ])->label('Khoa'); */ ?>
           <!--  </div>--> 
            <div class="col-md-3">
            	<?php 
            		/* $data = array();
	            	if($searchModel->idRoomParent != null){
	            		$data = (new Room())->getListByParent($searchModel->idRoomParent);
	    			}  */
    			?>
              <?= $form->field($searchModel, 'id_room')->widget(Select2::classname(), [
                    //'data' => $data,
                    'data'=>(new Room())->getList(),
                    'options' => ['id'=>'id_room','placeholder' => 'Chọn phòng/bộ môn ...'],
                    'attribute' => 'id_room',
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ]); ?>
            </div>
    
    	
    	
    	<div class="col-md-2">
  		 	<?= $form->field($searchModel, 'id_group')->widget(Select2::classname(), [
  		 	    'data' => (new DocGroup())->getListByRoom(),
                    'options' => ['placeholder' => 'Chọn nhóm ...'],
                    'attribute' => 'id_group',
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ]); ?>
    	</div>
    	
    	<div class="col-md-2">
  		<?= $form->field($searchModel, 'doc_year')->widget(Select2::classname(), [
  		        'data' => $searchModel->getAvailableYear(),
                'options' => ['placeholder' => 'Chọn năm...'],
                'attribute' => 'doc_year',
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]); ?>
  		</div>
    	
    	<div class="col-md-2">
    	<label>&nbsp;</label>
    	<br/>
    	<button type="button" onclick="openMoreSearch()" class="btn btn-primary btn-xs">Thêm thông tin <span class="caret"></span></button>
    	</div>
    </div><!-- row -->
   	<div class="row">
    	<div id="dHidden" style="display:none">
    	<div class="col-md-2">
  		 	<?= $form->field($searchModel, 'id_type')->widget(Select2::classname(), [
  		            'data' => (new DocType())->getList(),
                    'options' => ['placeholder' => 'Chọn loại ...'],
                    'attribute' => 'id_type',
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ]); ?>
    	</div>
    	
    	<!-- <div class="col-md-2">
  			<?= $form->field($searchModel, 'doc_ext')->textInput()  ?>
  		</div> -->
  		<div class="col-md-2">
  			<?= $form->field($searchModel, 'doc_no')->textInput()  ?>
  		</div>
  		
  		<div class="col-md-2">
  			<?php // $form->field($searchModel, 'doc_date')->textInput()  ?>
  			<?php 
  			   echo $form->field($searchModel, 'doc_date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Chọn ngày ký...'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd/mm/yyyy'
                    ]
                ]);
  			?>
  		</div>
  		<div class="col-md-2">
  			<?= $form->field($searchModel, 'doc_sign')->textInput()  ?>
  		</div>
  		
  		<div class="col-md-2">
  			<?= $form->field($searchModel, 'doc_summary')->textInput()  ?>
  		</div>
  		</div><!-- dHidden -->
  		
  		
    </div>

</div>


<?php ActiveForm::end(); ?>
</div>

<script>
function openMoreSearch(){
	$("#dHidden").toggle();
}
</script>