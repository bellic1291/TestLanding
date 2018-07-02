<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Pjax;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <?php $this->registerJsFile('@web/js/layout.js', ['position' => View::POS_END]);?>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $cart = \Yii::$app->cart;
    
    
    $tooltip = Html::tag('div', $cart->getTooltipText(), ['id' => 'tooltip']);
    
    NavBar::begin([
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    //Pjax::begin(['id' => 'tooltip']);
    $menuItems = [
        ['label' => 'Товары', 'url' => '/', 'options' => ['data-pjax' => '0']],
        ['label' => 'Доставка', 'options' => ['data-pjax' => '0']],
        ['label' => 'О компании', 'options' => ['data-pjax' => '0']],
        ['label' => 'FAQ', 'options' => ['data-pjax' => '0']],       
        ['label' => 'Таблица размеров', 'options' => ['data-pjax' => '0']],
        ['label' => 'Обратная связь', 'options' => ['data-pjax' => '0']],
        [
            'label' => '<b>Корзина </b>'.Html::tag('span', null, ['class' => 'glyphicon glyphicon-shopping-cart']).$tooltip,
            'encode' => false,
            'options' => ['style' => 'text-decoration: underline', 'class' => 'pull-right tooltip', 'id' => 'tooltip'],
        ],
    ];
    //Pjax::end();
    
    Pjax::begin(['id' => 'tooltip', 'linkSelector' => '.btn-card .span-grid .btn-clear']);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav', 'data-pjax' => '0'],
        'items' => $menuItems,
    ]);
    Pjax::end();
    
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">
            <span>Пункты выдачи:</span><br />
            г. Воронеж, Московский пр-т, 36а <br />
            г. Липецк, Площадь Ленина, 14
        </p>

        <p class="pull-right">
            <span>Контакты:</span><br />
            Телефон: 8(929)010-25-83<br/>
            Домашний телефон: 235-83-05<br/>
            E-mail: bellic12910@gmail.com
            
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
