<?php
use yii\helpers\Url;
use yii\helpers\Html;
$countModel = new \app\models\PcounterByDay();

return [
    /*[
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],*/
    /*[
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],*/
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'day',
    	'value' => function ($model){
    		return date("d/m/Y", strtotime($model->day));
    	},
    	'filter'=>false,
    	//'filter'=>Html::activeDropDownList($searchModel,'nam', $countModel->getListYear(),['class'=>'form-control',  'prompt'=>'--Chọn năm--']),
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'user',
    	'value' => function ($model){
    		return number_format($model->user);
    	},
    	'filter'=>false,
    	'pageSummary' => true
    	//'filter'=>Html::activeDropDownList($searchModel,'thang', $countModel->getListMonth(),['class'=>'form-control', 'prompt'=>'--Chọn tháng--']),
    ],
   /* [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) {
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'],
    ],*/

];