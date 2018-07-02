<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\web\View;

$this->title = 'My Yii Application';
$this->registerJsFile('@web/js/index.js', ['position' =>View::POS_END]);
?>
<div class="site-index">

    <div class="jumbotron">
        <p>Это небольшой интернет-магазин, написанный в качестве тестового задания для motoya. В navbar работает только корзина и товары.</p>
        <p><a href="https://github.com/bellic1291/TestLanding">Исходный код</a> добавил на GitHub для удобства.</p>
    </div>

    <div class="body-content">

        <div class="row div-flex-centered">
            
                <?php foreach ($models as $model) {
                    echo Html::beginTag('div', ['class' => 'col-lg-3 div-index-col', 'id' => $model->id]);
                    
                        echo Html::beginTag('div', ['class' => 'div-index-header']);
                            echo Html::tag('h4',$model->name);
                        echo Html::endTag('div');
                        
                        echo Html::tag('div', Html::tag('div', Html::img('@web/'.$model->photo_path, ['class' => 'index-img']), ['class' => 'index-img-cont']), ['class' => []]);
                        
                        echo Html::beginTag('div', []);
                            echo Html::tag('h4', 'От '.$model->getLowerPrice(). '<small>'.Html::tag('span', null, ['class' => 'glyphicon glyphicon-ruble']).'</small>');
                        echo Html::endTag('div');
                           
                    echo Html::endTag('div');
                }?>       
        </div>
    </div>
</div>
