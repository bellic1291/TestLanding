<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'name',
                'value' => function($model) {
                    return StringHelper::truncate($model->name, 36);
                }
            ],
            [
                'attribute' => 'characteristics',
                'value' => function($model) {
                    return StringHelper::truncate($model->characteristics, 26);
                }
            ],
            //'description',
            [
                'attribute' => 'description',
                'value' => function($model) {
                    return StringHelper::truncate($model->description, 26);
                }
            ],
            [
                'attribute' => 'photo_path',
                'value' => function($model) {
                    return Html::img('@frontend/web/'.$model->photo_path, ['class' => 'img-responsive']);
                },
                'filter' => false,
                'format' => 'raw',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
