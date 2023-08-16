<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\admin\models\RoomParent;

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
        'attribute'=>'room_parent',
    	'value'=>'roomParent.room_name',
    	'filter'=>Html::activeDropDownList($searchModel, 'room_parent', (new RoomParent())->getList(), 
    			['prompt'=>'-Tất cả-', 'class'=>'form-control']),
    	'options'=>['style'=>'width:30%']
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'room_code',
    	'options'=>['style'=>'width:10%']
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'room_name',
    ],
    [
        'class' => 'app\components\ActionColumnCustom',
        'options' => array('style' => 'width:250px'),
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
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