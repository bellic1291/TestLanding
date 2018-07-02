<?php

use yii\helpers\Html; 
use yii\web\View;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Корзина';
$this->registerJsFile('@web/js/cart.js', ['position' =>View::POS_END]);
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<div class="site-cart">
    <div class="cart-grid">
        <h1>Список товаров в корзине:</h1>
        <?php  Pjax::begin(['id' => 'cart-items-grid']);?>
        <?= GridView::widget([
            //'id' => 'cart-items-grid',
            'dataProvider' => $cart->getArrayDataProvider(),
            'summary' => false,
            'columns' => [
                [
                    'attribute' => 'name',
                    'label' => 'Полное наименование',
                ],
                [
                    'attribute' => 'price',
                    'label' => 'Цена за 1 шт.',
                ],
                [
                    'attribute' => 'quantity',
                    'label' => 'Количество',
                ],
                [
                    'attribute' => 'cost',
                    'label' => 'Цена',
                ],
                ['class' => 'yii\grid\ActionColumn',
                      'template' => '{minus}&nbsp;&nbsp;{plus}&nbsp;&nbsp;{remove}',
                      'buttons' => [
                            'minus' => function ($url, $model) {
                                return Html::tag('span', null, [
                                    'class' => 'glyphicon glyphicon-minus text-danger span-grid',
                                    'action' => '/cart/minus',
                                    'vr-id' => $model['vr_id'], 
                                ]);
                             },
                             
                             'plus' => function ($url, $model) {
                                return Html::tag('span', null, [
                                    'class' => 'glyphicon glyphicon-plus text-success span-grid',
                                    'action' => '/cart/plus',
                                    'vr-id' => $model['vr_id'], 
                                ]);
                             },
                             
                             'remove' => function ($url, $model) {
                                return Html::tag('span', null, [
                                    'class' => 'glyphicon glyphicon-trash span-grid',
                                    'action' => '/cart/remove',
                                    'vr-id' => $model['vr_id'], 
                                ]);
                             },
                                        
                      ],
                    ],
            ],
        ]);?>
        <div class="text-warning">
            <h4>Итог: <?= $cart->getTotalCost();?>
                <small><span class="glyphicon glyphicon-ruble"></span></small>
            </h4>
        </div>
        <?php  Pjax::end();?> 
        <h1>Ваши контактные данные:</h1>
        <?= $this->render('_contact', ['model' => $model]);?>
    </div>
</div>