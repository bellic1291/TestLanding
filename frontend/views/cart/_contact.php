<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\MaskedInput;

?>

<div class="container">
    <div class="row">
        <div class="col-md-5 contact-info">
            <div><span class="spn-red"></span> поля, обязательные для заполнения</div>
            <div><span class="spn-green"></span> одно из полей обязательно для заполнения</div>
        </div>
    </div>
    
    <?php $form = ActiveForm::begin(['enableClientValidation'=> true])?>
    <div class="row">
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'address') ?>
        <?= $form->field($model, 'email')?>
        <?= $form->field($model, 'phone')->widget(MaskedInput::className(), ['mask' => '+7(999)999-99-99', 'clientOptions' => [ 'removeMaskOnSubmit' => true ],]) ?>
        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>        
        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="captcha-container"><div class="col-md-2 captcha-img">{image}</div><div class="col-md-3 captcha-input">{input}</div></div>',
        ])?>
            
        <div class="form-group pull-right">
            <?= Html::submitButton('Отправить заказ', ['class' => 'btn btn-lg btn-success', 'style' => 'margin-right: 10px']) ?>
            <?= Html::a('Подробнее о доставке...', null, [])?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    
    
    



    

    
        
    
    
    
</div>
