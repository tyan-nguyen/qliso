<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tin tức/Bài viết';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<style>
.modal-dialog {
    width: 800px !important;
}
@media (max-width: 800px) {
   .modal-dialog {
      width: 99%!important; 
   }
}
</style>
<div class="news-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i> Thêm mới', ['create'],
                    ['role'=>'modal-remote','title'=> 'Thêm mới tin tức','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Tải lại', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Tải lại danh sách'])
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => '', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách',
                'before'=>'<em>* Có thể nhấn và kéo để thay đổi độ rộng của các cột dữ liệu.</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Xóa đã chọn',
                                ["bulk-delete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Xác nhận',
                                    'data-confirm-message'=>'Bạn có chắc chắn muốn xóa?'
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
 	"clientOptions" => [
        "backdrop" => "static", "keyboard" => false
     ]
])?>
<?php Modal::end(); ?>


