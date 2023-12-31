<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\manage\models\WorkingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Workings';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>

<?= $this->render('_search', ['searchModel' => $searchModel, 'curlink' => '']) ?>

<div class="working-index">

<?php \yii\widgets\Pjax::begin([
        'id'=>'search-grid-pjax1',
        'timeout' => false,
        'enablePushState' => false,
        'clientOptions' => [/*'container' => 'pjax-container',*/'method' => 'POST']
]); ?>
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create' . ($idEx!=null? ('?idEx=' . $idEx) :'')],
                        ['role'=>'modal-remote1', 'data-pjax' => 0, 'title'=> 'Create new Workings','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [($idEx!=null? ('?idEx=' . $idEx) :'')],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => '', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Workings listing',
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
    <?php \yii\widgets\Pjax::end(); ?>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

<script>
var delay = (function(){
	  var timer = 0;
	  return function(callback, ms, that){
	    clearTimeout (timer);
	    timer = setTimeout(callback.bind(that), ms);
	  };
	})();

function clearSearch(){
	document.getElementById("frm-search").reset();
	$('.sLoading').show();
	delay(function(){
	
    $.pjax.reload({
      url: $('#frm-search').attr('action'),
      type   : 'get',
      data   : $('#frm-search').serialize(),
      container: '#search-grid-pjax1',
       async: false,
      });
		$('.sLoading').hide();
  }, 300, this);
}
</script>
<?php 
$this->registerJs("
$('body').on('keyup change', '#frm-search input, #frm-search select', function(){
$('.sLoading').show();
	delay(function(){
	
      $.pjax.reload({
        url: $('#frm-search').attr('action'),
        type   : 'get',
        data   : $('#frm-search').serialize(),
        container: '#search-grid-pjax1',
         async: false,
        });
$('.sLoading').hide();
    }, 300, this);
		
});

",View::POS_END);
?>


