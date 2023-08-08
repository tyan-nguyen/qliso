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
    	
    	<div class="col-md-2">
  		 	<?= $form->field($searchModel, 'id_group')->widget(Select2::classname(), [
  		 	    'data' => (new DocGroup())->getListLong(),
                    'options' => ['placeholder' => 'Chọn nhóm ...'],
                    'attribute' => 'id_group',
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
  		
  		
  		
    </div>

</div>


<?php ActiveForm::end(); ?>
</div>