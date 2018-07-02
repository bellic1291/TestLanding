<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Items */

$this->title = 'Update Items: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="items-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
