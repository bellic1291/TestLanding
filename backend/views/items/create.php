<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Items */

$this->title = 'Create Items';
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
