<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\manage\models\Working */
?>
<div class="working-update">

    <?= $this->render('_formView', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'searchModelFiles' => $searchModelFiles,
        'dataProviderFiles' => $dataProviderFiles,
        'searchModelDocument' => $searchModelDocument,
        'dataProviderDocument' => $dataProviderDocument,
    ]) ?>

</div>
