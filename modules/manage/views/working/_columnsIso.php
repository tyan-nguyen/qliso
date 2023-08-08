<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\admin\models\Room;
use yii\bootstrap\ButtonDropdown;

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
        'options' => array('style' => 'width:50px'),
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'code',
        'value'=>'workingRoom.roomParent.room_name',
        'header'=>'Khoa',
        'options' => array('style' => 'width:100px'),
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_room',
        /* 'value'=>function($model){
            return $model->workingRoom->room_name;
        }, */
        'value'=>'workingRoom.room_name',
        'filter'=>Html::activeDropDownList($searchModel, 'id_room', (new Room())->getList(),
            ['prompt'=>'-Tất cả-', 'class'=>'form-control']),
        'options' => array('style' => 'width:100px'),
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'date_exam',
        'options' => array('style' => 'width:75px'),
    ],
  /*   [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'date_created',
        'options' => array('style' => 'width:100px'),
    ], */
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
   /* [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{all}',
        'options' => array('style' => 'width:150px'),
        'buttons' => [
            'all' => function ($url, $model, $key) {
            return ButtonDropdown::widget([
                'encodeLabel' => false, // if you're going to use html on the button label
                'label' => 'Options',
                'dropdown' => [
                    'encodeLabels' => false, // if you're going to use html on the items' labels
                    'items' => [
                        [
                            'label' => \Yii::t('yii', 'View'),
                            'url' => ['view', 'id' => $key],
                            'linkOptions' => [
                                'role'=>'modal-remote1', 'data-pjax'=>0, 'target'=>'_blank', 'title'=>'View','data-toggle'=>'tooltip', 'class'=>'btn btn-primary btn-xs'
                            ]
                        ],
                        [
                            'label' => \Yii::t('yii', 'Update'),
                            'url' => ['update', 'id' => $key],
                            //'visible' => true,  // if you want to hide an item based on a condition, use this
                            'linkOptions' => [
                                'role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip','class'=>'btn btn-warning btn-xs'
                            ]
                        ],
                        [
                            'label' => \Yii::t('yii', 'Delete'),
                            'linkOptions' => [
                                'role'=>'modal-remote','title'=>'Delete',
                                'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                'class'=>'btn btn-danger btn-xs',
                                'data-request-method'=>'post',
                                'data-toggle'=>'tooltip',
                                'data-confirm-title'=>'Are you sure?',
                                'data-confirm-message'=>'Are you sure want to delete this item'
                            ],
                            'url' => ['delete', 'id' => $key],
                            'visible' => true,   // same as above
                        ],
                    ],
                    'options' => [
                        'class' => 'dropdown-menu-right', // right dropdown
                    ],
                ],
                'options' => [
                    'class' => 'btn-default',   // btn-success, btn-info, et cetera
                ],
                'split' => true,    // if you want a split button
            ]);
         },
      ],
    ],*/
    [
        'header'=>'',
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
         'template'=>'{view} {update}',
         /*'buttons' => [
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
            'options' => array('style' => 'width:75px'),
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