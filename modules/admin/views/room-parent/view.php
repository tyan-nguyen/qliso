<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\RoomParent */
?>
<div class="room-parent-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           //'id',
            'room_name',
        ],
    ]) ?>

</div>
