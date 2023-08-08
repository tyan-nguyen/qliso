<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\WorkingFiles */
?>
<div class="working-files-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'id_user',
            'file_name',
            'file_url:url',
            //'shared_with',
            'summary:ntext',
            'date_created',
            'user_created'=>[
                'attribute'=>'user_created',
                'value'=>$model->userCreated
            ]
        ],
    ]) ?>

</div>
