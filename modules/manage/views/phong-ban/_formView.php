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

$this->title="Cuộc họp #" . $model->id;

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\Working */
/* @var $form yii\widgets\ActiveForm */

if($model->date_exam != null){
    $custom = new Custom();
    $model->date_exam = $custom->convertYMDtoDMY($model->date_exam);
}

?>

<style>
#ajaxCrudDatatable .panel-heading{
    display: none;
}
#ajaxCrudDatatable1 .panel-heading{
    display: none;
}
#ajaxCrudDatatable2 .panel-heading{
    display: none;
}
</style>

<div class="working-form row">
    

    
<div class="col-md-7">
    
    
    <div class="box box-solid">
    <div class="box-header ui-sortable-handle" style="cursor: move;">
        <i class="fa fa-calendar"></i>
        <h3 class="box-title">Biểu mẫu</h3>
        
        <div class="pull-right box-tools">

            <button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    
    </div>

    <div class="box-body" style="">
    	
    	 <div id="ajaxCrudDatatable1">
              <?= $model->isNewRecord ? 
				        	'<div class="alert" role="alert">Vui lòng lưu và tạo file</div>' 
							:GridView::widget([
                'id'=>'crud-datatable1',
                'dataProvider' => $dataProviderFiles,
                //'filterModel' => $searchModelFiles,
                'pjax'=>true,
				'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
                'columns' => require(__DIR__.'/../working-files/_columnsPhongBan.php'),
                'toolbar'=> [
                    ['content'=>''
                      /*  Html::a('<i class="glyphicon glyphicon-plus"></i>', ['working-files/create?idWorking='.$model->id],
                        ['role'=>'modal-remote','title'=> 'Create working file','class'=>'btn btn-default']) */
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
                    'type' => '', 
                    //'heading' => '<i class="glyphicon glyphicon-list"></i> working filess listing',
                    'before'=>'<em>* Danh sách biểu mẫu biên bản và phiếu ý kiến cho thành viên đoàn kiểm tra.</em>',
                    /* 'after'=>BulkButtonWidget::widget([
                                'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Xóa đã chọn',
                                    ["working-files/bulk-delete"] ,
                                    [
                                        "class"=>"btn btn-danger btn-xs",
                                        'role'=>'modal-remote-bulk',
                                        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                        'data-request-method'=>'post',
                                        'data-confirm-title'=>'Bạn có chắc chắn thực hiện?',
                                        'data-confirm-message'=>'Xác nhận xóa thông tin?'
                                    ]),
                            ]).                        
                            '<div class="clearfix"></div>', */
                ]
            ])?>
        </div>
        </div>
        </div>
        
       
    
    <div class="box box-solid">
    <div class="box-header ui-sortable-handle" style="cursor: move;">
        <i class="fa fa-calendar"></i>
        <h3 class="box-title">Tài liệu kiểm chứng</h3>
        
        <div class="pull-right box-tools">
        	<?= Html::a('<i class="glyphicon glyphicon-paperclip"></i> Thêm', ['document/create?idWorking='.$model->id],
                        ['role'=>'modal-remote','title'=> 'Create documents','class'=>'btn btn-sm btn-primary']) ?>
            <button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    
    </div>

    <div class="box-body" style="">
    	
    	 <div id="ajaxCrudDatatable2">
              <?= $model->isNewRecord ? 
				        	'<div class="alert" role="alert">Vui lòng lưu cuộc họp để hiển thị</div>' 
							:GridView::widget([
                'id'=>'crud-datatable2',
                'dataProvider' => $dataProviderDocument,
				//'filterModel' => $searchModelDocument,
                'pjax'=>true,
                'columns' => require(__DIR__.'/../document/_columns.php'),
                'toolbar'=> [
                    ['content'=>''
                       /* Html::a('<i class="glyphicon glyphicon-plus"></i>', ['document/create?idWorking='.$model->id],
                        ['role'=>'modal-remote','title'=> 'Create documents','class'=>'btn btn-default']) */
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
                    'type' => '', 
                    'heading' => '<i class="glyphicon glyphicon-list"></i> working document',
                    'before'=>'<em>* Danh sách tài liệu chứng minh phòng/ban tải lên.</em>',
                    'after'=>BulkButtonWidget::widget([
                                'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Xóa đã chọn',
                                    ["document/bulk-delete"] ,
                                    [
                                        "class"=>"btn btn-danger btn-xs",
                                        'role'=>'modal-remote-bulk',
                                        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                        'data-request-method'=>'post',
                                        'data-confirm-title'=>'Bạn có chắc chắn thực hiện?',
                                        'data-confirm-message'=>'Xác nhận xóa thông tin?'
                                    ]),
                            ]).                        
                            '<div class="clearfix"></div>',
                ]
            ])?>
            </div>
          </div>
            
            
        </div><!-- col-md-7 -->
        
       
    
    </div>
    
    <div class="col-md-5">
    


<div class="box box-solid">
    <div class="box-header ui-sortable-handle" style="cursor: move;">
        <i class="fa fa-calendar"></i>
        <h3 class="box-title">Đoàn kiểm tra</h3>
        
        <div class="pull-right box-tools">
            <button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    
    </div>

    <div class="box-body" style="">
    	
    	 <div id="ajaxCrudDatatable">
              <?= $model->isNewRecord ? 
				        	'<div class="alert" role="alert">Vui lòng lưu tạm để thêm thành viên</div>' 
							:GridView::widget([
                'id'=>'crud-datatable',
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'pjax'=>true,
                'columns' => require(__DIR__.'/../team-member/_columnsPhongBan.php'),
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
                    'type' => '', 
                    'heading' => '<i class="glyphicon glyphicon-list"></i> Team Members listing',
                    'before'=>'<em>* Danh sách thành viên đoàn kiểm tra.</em>',
                    /* 'after'=>BulkButtonWidget::widget([
                                'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Xóa đã chọn',
                                    ["team-member/bulk-delete"] ,
                                    [
                                        "class"=>"btn btn-danger btn-xs",
                                        'role'=>'modal-remote-bulk',
                                        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                        'data-request-method'=>'post',
                                        'data-confirm-title'=>'Bạn có chắc chắn thực hiện?',
                                        'data-confirm-message'=>'Xác nhận xóa thông tin?'
                                    ]),
                            ]).                        
                            '<div class="clearfix"></div>', */
                ]
            ])?>
        </div>
       </div>
    </div> 
    
    
    <div class="box box-solid">
    <div class="box-header ui-sortable-handle" style="cursor: move;">
        <i class="fa fa-calendar"></i>
        <h3 class="box-title">Thông tin cuộc họp</h3>
        
        <div class="pull-right box-tools">
            <button type="button" class="btn btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
           
        </div>
    
    </div>

    <div class="box-body" style="">
    	<div class="row">
    		<?= $this->render('../working/_viewInForm', ['model'=>$model]) ?>
    	</div>
        <?php /* $form = ActiveForm::begin(); ?>
        
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
    	
    	 <?php // Html::submitButton('<span class="glyphicon glyphicon-floppy-save"></span> Lưu tạm', 
    	        //		['name'=>'btnSubmit','value'=>'justSave','class' => 'btn btn-primary margint5']) ?>
    	        
    	<?php // Html::submitButton('<span class="glyphicon glyphicon-check"></span> Lưu và thoát', 
    	       // 		['name'=>'btnSubmit','value'=>'saveAndExit','class' => 'btn btn-primary  margint5']) ?>
    			
    	
    
        <?php ActiveForm::end(); */ ?>    
    </div>
</div>

       
    
    </div><!-- col-md-5 -->
    
     <?php Modal::begin([
            "id"=>"ajaxCrudModal",
            "footer"=>"",// always need it for jquery plugin
        ])?>
        <?php Modal::end(); ?>
    
  
</div>
