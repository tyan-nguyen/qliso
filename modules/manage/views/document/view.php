<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\Document */
?>
<div class="document-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            #'id',
            #'id_working',
            'document_name',
            'document_url:url',
            'document_type',
            'summary:ntext',
            'date_created',
            'user_created'=>[
                'attribute'=>'user_created',
                'value'=>$model->userCreated
            ]
        ],
    ]) ?>

</div>
