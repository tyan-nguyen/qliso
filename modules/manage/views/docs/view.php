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
                'value'=>$model->group->name
            ],
            'code',
            'doc_name',
            'doc_ext',
            'doc_url:url',
            'summary:ntext',
            'user_created'=>[
                'attribute'=>'user_created',
                'value'=>$model->userCreated
            ],
            'date_created',
            'doc_no',
            'doc_summary:ntext',
            'doc_date',
            'doc_sign',
        ],
    ]) ?>

</div>
