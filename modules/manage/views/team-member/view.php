<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\TeamMember */
?>
<div class="team-member-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'id_working'=>[
                'attribute' => 'id_working',
                'format' => 'html',
                'value'=>$model->memberWorking->workingNameHtml
            ],
            'id_position'=>[
                'attribute' => 'id_position',
                'value'=>$model->memberPosition->name
            ],
            'id_user'=>[
                'attribute' => 'id_user',
                'value'=>$model->memberUser->username
            ],
            'summary:ntext',
            'date_created',
            'user_created'=>[
                'attribute'=>'user_created',
                'value'=>$model->userCreated
            ]
        ],
    ]) ?>

</div>
