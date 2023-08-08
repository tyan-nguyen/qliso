<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\manage\models\Iso;

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
        'attribute'=>'name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'iso',
        'value'=>function($model){
            return $model->iso->name;
        },
        'filter'=>Html::activeDropDownList($searchModel, 'id_iso', (new Iso())->getList(), 
            [
                'prompt' => '-Tất cả-',
                'class' => 'form-control'
            ]
        )
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'summary',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'date_created',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'user_created',
        'value'=>'userCreated'
    ],
    [
        'header'=>'',
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'template'=>'{allEx} {view} {update}',
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
        ],
        'options' => array('style' => 'width:150px'),
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip', 'class'=>'btn btn-primary btn-xs'],
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