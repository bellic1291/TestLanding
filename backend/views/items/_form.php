<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Items */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'characteristics')->widget(CKEditor::className(),[
    'editorOptions' => [
        'preset' => 'full', 
        'inline' => false, 
    ],
]); ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(),[
    'editorOptions' => [
        'preset' => 'full',
        'inline' => false, 
    ],
]); ?>

    <?= $form->field($model, 'photo_path')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
