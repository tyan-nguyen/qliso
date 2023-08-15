<?php
use yii\helpers\Url;

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
    /* [
     'class'=>'\kartik\grid\DataColumn',
     'attribute'=>'id_working',
     ], */
    /* [
     'class'=>'\kartik\grid\DataColumn',
     'attribute'=>'document_name',
     ], */
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'document_url',
        'label'=>'Type',
        'format'=>'html',
        'value'=>function($model){
        return $model->getDocumentType();
        }
     ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'document_type',
        'format'=>'html',
        'value'=>function($model){
        return '<span class="badge badge-success">' . $model->document_type . '</span>';
        }
     ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'summary',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'date_created',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'user_created',
        'value'=>function($model){
        return $model->getUserCreated();
        }
    ],
    [
        'header'=>'',
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
       // 'template'=>'{download} {view} {update} {delete}',
        'template'=>'{download} {view}',
        'buttons' => [
            'download' => function ($url, $model, $key) {
            return yii\helpers\Html::a('<span class="glyphicon glyphicon-cloud-download"></span> Tải về',
                Yii::getAlias('@web') . '/manage/document/download?id='
                . $model->id
                , [
                    'class' => 'btn btn-info btn-xs grid-action',
                    'title' => Yii::t('app', 'Download'),
                    'role'=>'modal-remote1',
                    'data-pjax'=>0,
                    'target'=>'_blank',
                    'data-toggle'=>'tooltip'
                ]);
            },
            'view' => function ($url, $model, $key) {
            return yii\helpers\Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem',
                Yii::getAlias('@web') . '/manage/document/view-public?id='
                . $model->id
                , [
                    'class' => 'btn btn-info btn-xs grid-action',
                    'title' => Yii::t('app', 'Xem'),
                    'role'=>'modal-remote',
                    'data-toggle'=>'tooltip'
                ]);
            },
            'update' => function ($url, $model, $key) {
            return yii\helpers\Html::a('<span class="glyphicon glyphicon-pencil"></span> Cập nhật',
                Yii::getAlias('@web') . '/manage/document/update?id='
                . $model->id
                , [
                    'class' => 'btn btn-warning btn-xs grid-action',
                    'title' => Yii::t('app', 'Cập nhật'),
                    'role'=>'modal-remote',
                    'data-toggle'=>'tooltip'
                ]);
            },
            'delete' => function ($url, $model, $key) {
            return yii\helpers\Html::a('<span class="glyphicon glyphicon-remove"></span> Xóa',
                Yii::getAlias('@web') . '/manage/document/delete?id='
                . $model->id
                , [
                    'class' => 'btn btn-danger btn-xs grid-action',
                    'role'=>'modal-remote','title'=>'Xóa',
                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                    'data-request-method'=>'post',
                    'data-toggle'=>'tooltip',
                    'data-confirm-title'=>'Xác nhận',
                    'data-confirm-message'=>'Bạn có chắc chắn muốn xóa?'
                ]);
            },
       ],
       'visibleButtons'=>[
                'viewDrive'=> function($model){
                return ($model->file_url != null);
                },
        ],
        'options' => array('style' => 'width:300px'),
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   