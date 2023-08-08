<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\Docs */
?>
<div class="docs-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_type',
            'id_group',
            'code',
            'doc_name',
            'doc_ext',
            'doc_url:url',
            'summary:ntext',
            'user_created',
            'date_created',
            'doc_no',
            'doc_summary:ntext',
            'doc_date',
            'doc_sign',
        ],
    ]) ?>

</div>
