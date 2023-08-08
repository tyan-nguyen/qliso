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

<div class="col-md-6">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model) ?>

    <?php // $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'id_examination')->textInput() ?>

    <?= $form->field($model, 'id_room')->widget(Select2::classname(), [
                    'data' => (new Room())->getList(),
                    'options' => ['id'=>'id_room_frm','placeholder' => 'Chọn phòng/bộ môn ...'],
                    'attribute' => 'id_room',
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ]); ?>
    
    <?php /*
        $form->field($model, 'date_exam')->widget(DatePicker::classname(), [
              'attribute' => 'date_exam',
              'template' => '{input}{addon}',
                  'clientOptions' => [
                      'autoclose' => true,
                      'format' => 'dd/mm/yyyy'
                  ]
          ]);*/ ?>
          
   <?php /* DatePicker::widget([
    'model' => $model,
    'attribute' => 'date_exam',
    'template' => '{addon}{input}',
       'inline' => false, 
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd/mm/yyyy'
        ]
]); */ ?>

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

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>
	
	 <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-save"></span> Lưu tạm', 
	        		['name'=>'btnSubmit','value'=>'justSave','class' => 'btn btn-primary margint5']) ?>
	        
	        <?= Html::submitButton('<span class="glyphicon glyphicon-check"></span> Lưu và thoát', 
	        		['name'=>'btnSubmit','value'=>'saveAndExit','class' => 'btn btn-primary  margint5']) ?>
	        		
	        		<?= Html::a('<i class="fa fa-plus-circle"></i> Tạo file biểu mẫu', ['file/create?idWorking=' . $model->id],
						                				['role'=>'modal-remote','title'=> 'Tạo file biểu mẫu','class'=>'btn btn-default']); ?>

    <?php ActiveForm::end(); ?>
    
      </div>
    
    <div class="col-md-6">
    	
    	 <div id="ajaxCrudDatatable">
              <?= $model->isNewRecord ? 
				        	'<div class="alert" role="alert">Vui lòng lưu tạm để thêm thành viên</div>' 
							:GridView::widget([
                'id'=>'crud-datatable',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pjax'=>true,
                'columns' => require(__DIR__.'/../team-member/_columns.php'),
                'toolbar'=> [
                    ['content'=>
                        Html::a('<i class="glyphicon glyphicon-plus"></i>', ['team-member/create?idWorking='.$model->id],
                        ['role'=>'modal-remote','title'=> 'Create new Team Members','class'=>'btn btn-default'])
                       /* Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['?idWorking='.$model->id],
                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                        '{toggleData}'.
                        '{export}' */
                    ],
                ],          
                'striped' => true,
                'condensed' => true,
                'responsive' => true,          
                'panel' => [
                    'type' => 'primary', 
                    'heading' => '<i class="glyphicon glyphicon-list"></i> Team Members listing',
                    'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                    'after'=>BulkButtonWidget::widget([
                                'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                    ["bulk-delete"] ,
                                    [
                                        "class"=>"btn btn-danger btn-xs",
                                        'role'=>'modal-remote-bulk',
                                        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                        'data-request-method'=>'post',
                                        'data-confirm-title'=>'Are you sure?',
                                        'data-confirm-message'=>'Are you sure want to delete this item'
                                    ]),
                            ]).                        
                            '<div class="clearfix"></div>',
                ]
            ])?>
        </div>
        
       
    
    </div>
    
    <div class="col-md-6">
    	
    	 <div id="ajaxCrudDatatable1">
              <?= $model->isNewRecord ? 
				        	'<div class="alert" role="alert">Vui lòng lưu và tạo file</div>' 
							:GridView::widget([
                'id'=>'crud-datatable1',
                'dataProvider' => $dataProviderFiles,
                'filterModel' => $searchModelFiles,
                'pjax'=>true,
                'columns' => require(__DIR__.'/../working-files/_columns.php'),
                'toolbar'=> [
                    ['content'=>''
                       /*  Html::a('<i class="glyphicon glyphicon-plus"></i>', ['team-member/create?idWorking='.$model->id],
                        ['role'=>'modal-remote','title'=> 'Create new Team Members','class'=>'btn btn-default']) */
                       /* Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['?idWorking='.$model->id],
                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                        '{toggleData}'.
                        '{export}' */
                    ],
                ],          
                'striped' => true,
                'condensed' => true,
                'responsive' => true,          
                'panel' => [
                    'type' => 'primary', 
                    'heading' => '<i class="glyphicon glyphicon-list"></i> working filess listing',
                    'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                    'after'=>BulkButtonWidget::widget([
                                'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                    ["bulk-delete"] ,
                                    [
                                        "class"=>"btn btn-danger btn-xs",
                                        'role'=>'modal-remote-bulk',
                                        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                        'data-request-method'=>'post',
                                        'data-confirm-title'=>'Are you sure?',
                                        'data-confirm-message'=>'Are you sure want to delete this item'
                                    ]),
                            ]).                        
                            '<div class="clearfix"></div>',
                ]
            ])?>
        </div>
        
       
    
    </div>
    
     <?php Modal::begin([
            "id"=>"ajaxCrudModal",
            "footer"=>"",// always need it for jquery plugin
        ])?>
        <?php Modal::end(); ?>
    
  
</div>
