<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Room */
?>
<div class="room-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'roomParent.room_name',
            'room_code',
            'room_name',
        ],
    ]) ?>

</div>
