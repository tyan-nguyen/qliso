<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\DocGroup */
?>
<div class="doc-group-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'id_iso'=>[
                'attribute'=>'id_iso',
                'value'=>$model->iso->name
            ],
            'date_created',
            'user_created'=>[
                'attribute'=>'user_created',
                'value'=>$model->userCreated
            ]
        ],
    ]) ?>

</div>
