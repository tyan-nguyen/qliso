<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\manage\models\DocType;
use app\modules\manage\models\DocGroup;
use app\models\User;

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
        'attribute'=>'id_type',
        'value'=>function($model){
            return $model->type->name;
        },
        'filter'=>Html::activeDropDownList($searchModel, 'id_type', (new DocType())->getList(), [
            'prompt' => '-Tất cả-',
            'class' => 'form-control'
        ])
    ],
   
    /* [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'code',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'doc_name',
    ], */
    /* [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'doc_ext',
    ], */
        [
            'class'=>'\kartik\grid\DataColumn',
            'attribute'=>'doc_ext',
            'label'=>'Ext',
            'format'=>'html',
            'value'=>'fileExtIcon',
            'options' => array('style' => 'width:50px'),
        ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'doc_no',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'doc_summary',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'doc_date',
        'value'=>'docDate'
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'doc_sign',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'doc_url',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'summary',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'user_created',
    // ],
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'doc_year',
        'format'=>'raw',
        'group' => true,  // enable grouping,
        'groupedRow' => true,                    // move grouped column to a single grouped row
        'groupOddCssClass' => 'kv-grouped-row',  // configure odd group cell css class
        'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class
        'value'=>function($model){
            return 'Năm ' . $model->doc_year;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_room',
        'value'=>'room.room_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_group',
        'value'=>function($model){
            return $model->group!=null?$model->group->name:'';
        },
    ],
    [
        'header'=>'',
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'template'=>'{download}  {view} {update}',
        'buttons' => [
            'download' => function ($url, $model, $key) {
            return yii\helpers\Html::a('<span class="glyphicon glyphicon-cloud-download"></span>',
                Yii::getAlias('@web') . '/manage/docs/download?id='
                . $model->id
                , [
                    'class' => 'btn btn-info btn-xs grid-action',
                    'title' => Yii::t('app', 'Tải về'),
                    'role'=>'modal-remote1',
                    'data-pjax'=>0,
                    'target'=>'_blank',
                    'data-toggle'=>'tooltip'
                ]);
            },
         ],
         'visibleButtons'=>[
             'update'=> function($model){
             return User::hasPermission('per_admin_kho_du_lieu');
             },
        ],
        'viewOptions'=>['role'=>'modal-remote','title'=>'Xem chi tiết','data-toggle'=>'tooltip', 'class' => 'btn btn-info btn-xs grid-action',],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Cập nhật', 'data-toggle'=>'tooltip', 'class' => 'btn btn-warning btn-xs grid-action',],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   