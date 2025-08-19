<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Добавить контакт';
$this->params['breadcrumbs'][] = ['label' => 'Контакты', 'url' => ['site/index', 'type' => 'contact']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="contact-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'dealIds')->listBox(
            ArrayHelper::map($deals, 'id', 'name'),
            [
                'multiple' => true,
                'size' => 10,
                'options' => [
                    'style' => 'height: 200px;'
                ]
            ]
        )->label('Сделки (для выбора нескольких удерживайте Ctrl)') ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>