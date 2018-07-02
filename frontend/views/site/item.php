<?php

use yii\helpers\Html; 
use yii\web\View;
use yii\grid\GridView;
use common\models\ItemsVariation;
use yii\bootstrap\Alert;

$this->title = $model->name;
$this->registerJsFile('@web/js/item-index.js', ['position' => View::POS_END]);
?>
 <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
 <div class="site-item">
    <div class="body-content">
        <div class="row">
            <div class="col-md-5 flex-div">
                <div>
                    <?= Html::img('@web/'.$model->photo_path, ['class' => 'item-img']); ?>
                    <div style="display: flex; flex-direction: column; float: right; padding: 20px 0;">
                    <?= Html::tag('button', Html::img('@web/'.$model->photo_path, ['class' => 'vr-img']), ['class' => 'btn vr-img-btn', 'autofocus' => 'true']);  ?>
                        <?php foreach ($model->itemsVariations as $variation) {
                                foreach ($variation->itemsPhotos as $photo) {
                                    if ($photo->visible == $photo::VISIBLE) {
                                        echo Html::tag('button', Html::img('@web/'.$photo->photo_path, ['class' => 'vr-img']), [
                                            'class' => 'btn vr-img-btn',
                                        ]);  
                                    }
                                }
                              }
                        ?>
                    </div>
                </div>
                <div style="text-align: center; margin-top: 10px; background-color: #f8f8f8; border: 1px solid #e7e7e7; padding: 0 15px 10px;">
                    <h2 class="lead-text">Описание</h2>
                    <div style="text-align: left">
                        <p><?= $model->description?></p>
                    </div>
                </div>
            </div>
            

            
            <div class="col-md-7">
                <div style="text-align: center; margin-bottom: 25px;"><h2 class="lead-text">Характеристики:</h2></div>
                <p>
                    <?= $model->characteristics?>
                </p>
                <?= Html::tag('button', 'Выбрать разновидность <small><span class="glyphicon glyphicon-menu-down"></span></small>', [
                    'class' => 'btn btn-lg btn-default collapsed',
                    'style' => 'width: 100%; border-radius: 0; margin-top: 10px;',
                    'data-toggle' => 'collapse',
                    'data-target' => '#vr-div',
                ])?>
                <div class="collapse" id="vr-div">
                    <?php echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'summary' => false,
                            'columns' => [
                                [  
                                    'value' => function($model) {
                                        return Html::tag('div', 
                                            Html::img('@web/'.ItemsVariation::getOnePhotoPathById($model->id),['class' => 'vr-img']), 
                                            ['class' => 'vr-grid-div']
                                        ); 
                                    },
                                    'format' => 'raw',
                                    'options' => ['style' => 'width: 15%'],
                                ],
                                'name',
                                [
                                    'attribute' => 'availability',
                                    'value' => function($model) {
                                        return ItemsVariation::getStatusNameById($model->availability);
                                    },
                                    'format' => 'raw',
                                ],
                                'price',
                                [
                                    'value' => function($model) {
                                        return Html::tag('button', 'Добавить в '.Html::tag('span', null, ['class' => 'glyphicon glyphicon-shopping-cart']), [
                                            'class' => 'btn btn-cart',
                                            'id' => $model->id,
                                        ]);
                                    },
                                    'format' => 'raw',
                                    'options' => ['style' => 'width: 3%'],
                                ],
                                
                            ],
                    ])?>
                </div>
            </div>
        </div>

    </div>
</div>
