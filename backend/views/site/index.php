<?php

use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\helpers\Url;

$this->title = 'Панель управления';

$data_items = new ArrayDataProvider([
        'allModels' => [
                        ["link"=>Html::a('Список товаров', Url::to('/items/index'))], 
                        ["link"=>Html::a('Загрузить фото', null)], 
        ],  
]);


$data_requests = new ArrayDataProvider([
        'allModels' => [
                        ["link"=>Html::a('Список заявок', null)],
                        ["link"=>Html::a('Архив заявок', null)], 
        ],  
]);

?>
<div class="site-index">
    <div class="row">
        <div class="col-md-3">
            <?= GridView::widget([
                'dataProvider' => $data_items,
                'summary' => '',
                'columns' => [
                    [
                        'visible' => false,
                    ],
                    [
                        'attribute' => 'link',
                        'label'     => 'Управление товарами',
                        'format' => 'raw',
                    ],
                    ]
                ]);
            ?>
        </div>
        <div class="col-md-3" >
            <?= GridView::widget([
                'dataProvider' => $data_requests,
                'summary' => '',
                'columns' => [
                    [
                        'visible' => false,
                    ],
                    [
                        'attribute' => 'link',
                        'label'     => 'Управление заявками',
                        'format' => 'raw',
                    ],
                    ]
                ]);
            ?>
        </div>
        
    </div>
</div>
