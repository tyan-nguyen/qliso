<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'type',
    	'value'=>function($model){
    		return $model->getTypeText();
    	},
    	'filter'=>Html::activeDropDownList($searchModel, 'type', $searchModel->getType(), ['prompt'=>'-Tất cả-', 'class'=>'form-control'])
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'title',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'date',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'author',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'public',
    	'format'=>'raw',
    	'value'=>function($model){
    		return $model->public==1 
    		? '<span class="label label-success">Công bố</span>' 
    		: '<span class="label label-default">Tạm ẩn</span>';
    	},
    	'filter'=>Html::activeDropDownList($searchModel, 'public', [0=>'Tạm ẩn', 1=> 'Công bố'], ['prompt'=>'-Tất cả-', 'class'=>'form-control'])
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'content',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'view',
    	'value'=>function($model){
    		return number_format($model->view);
    	}
    ],
    [
    		'class'=>'\kartik\grid\DataColumn',
    		'attribute'=>'level',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'slug',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'public',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'template'=>'{update} {delete}',
        'options' => array('style' => 'width:150px'),
        'viewOptions'=>['role'=>'modal-remote','title'=>'Xem','data-toggle'=>'tooltip','class'=>'btn btn-primary btn-xs'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Sửa', 'data-toggle'=>'tooltip','class'=>'btn btn-warning btn-xs'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Xóa',
        				  'class'=>'btn btn-danger btn-xs', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Xác nhận',
                          'data-confirm-message'=>'Bạn có chắc chắn muốn xóa?'], 
    ],

];   