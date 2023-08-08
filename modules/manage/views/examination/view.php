<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\Examination */
?>
<div class="examination-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'summary:ntext',
            'date_created',
            'user_created'=>[
                'attribute'=>'user_created',
                'value'=>$model->userCreated
            ]
        ],
    ]) ?>

</div>
