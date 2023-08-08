<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PcounterByDay */
?>
<div class="pcounter-by-day-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'day',
            'user',
        ],
    ]) ?>

</div>
