<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\Docs */
?>
<div class="docs-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'id_type'=>[
                'attribute'=>'id_type',
                'value'=>$model->type->name
            ],
            'id_group'=>[
                'attribute'=>'id_group',
                'value'=>$model->group!=NULL?$model->group->name:''
            ],
            'idRoomParent'=>[
                'attribute'=>'idRoomParent',
                'value'=>$model->room!=null?$model->room->roomParent->room_name:''
            ],
            'id_room'=>[
                'attribute'=>'id_room',
                'value'=>$model->room!=null?$model->room->room_name:''
            ],
            'id_dm'=>[
                'attribute'=>'id_dm',
                'value'=>$model->dm!=null?$model->dm->name:''
            ],
            'code',
            'doc_name',
            'doc_ext',
            'doc_url:url',          
            
            'doc_no',
            'doc_summary:ntext',
            'doc_date',
            'doc_sign',
            'summary:ntext',
            'user_created'=>[
                'attribute'=>'user_created',
                'value'=>$model->userCreated
            ],
            'date_created',
        ],
    ]) ?>

</div>
