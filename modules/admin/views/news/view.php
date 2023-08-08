<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\News */
?>
<div class="news-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'title',
            'date',
            'author',
            'description:ntext',
            'content:ntext',
            'view',
            'slug',
            'public',
        ],
    ]) ?>

</div>
