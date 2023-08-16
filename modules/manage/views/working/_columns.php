<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\admin\models\Room;

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
        'attribute'=>'code',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_examination',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_room',
        'value'=>'workingRoom.room_name',
        'filter'=>Html::activeDropDownList($searchModel, 'id_room', (new Room())->getList(),
            ['prompt'=>'-Tất cả-', 'class'=>'form-control']),
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'date_exam',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'date_created',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'user_created',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'summary',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_template_group',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_template_single',
    // ],
    [
        'header'=>'',
        'class' => 'app\components\ActionColumnCustom',
        'options' => array('style' => 'width:250px'),
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
       /*  'template'=>'{view} {update} {delete}',
        'buttons' => [
            'allEx' => function ($url, $model, $key) {
            return yii\helpers\Html::a('<span class="glyphicon glyphicon-th-large"></span>',
                Yii::getAlias('@web') . '/manage/working/index?idEx=' . $model->id
                , [
                    'target'=>'_blank',
                    'class' => 'btn btn-info btn-xs grid-action',
                    'title' => Yii::t('app', 'Quản lý cuộc họp'),
                    'role'=>'modal-remote1',
                    'data-toggle'=>'tooltip'
                ]);
            },
            ], */
            'viewOptions'=>['role'=>'modal-remote1', 'data-pjax'=>0, 'target'=>'_blank', 'title'=>'View','data-toggle'=>'tooltip', 'class'=>'btn btn-primary btn-xs'],
            'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip','class'=>'btn btn-warning btn-xs'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'class'=>'btn btn-danger btn-xs', 
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   