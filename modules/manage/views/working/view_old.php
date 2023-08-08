<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\Working */
?>
<div class="working-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'id_examination',
            'id_room',
            'date_exam',
            'date_created',
            'user_created',
            'summary:ntext',
            'id_template_group',
            'id_template_single',
        ],
    ]) ?>

</div>
