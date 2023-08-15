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
   /*  [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_working',
        
    ], */
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_position',
        'value'=>function($model){
            return $model->memberPosition->name;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_user',
        'value'=>function($model){
            return $model->memberUser->info->name;
        }
    ],
    /* [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'summary',
    ], */
    /* [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'date_created',
    ], */
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'user_created',
    // ],
    [
        'header'=>'',
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'template'=>'{view}',
        'buttons' => [
            'view' => function ($url, $model, $key) {
                return yii\helpers\Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem',
                    Yii::getAlias('@web') . '/manage/team-member/view-public?id='
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
                    Yii::getAlias('@web') . '/manage/team-member/update?id='
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
                    Yii::getAlias('@web') . '/manage/team-member/delete?id='
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
        'options' => array('style' => 'width:150px'),
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