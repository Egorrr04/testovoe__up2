<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Редактировать сделку: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Сделки', 'url' => ['site/index', 'type' => 'deal']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['site/index', 'type' => 'deal', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="deal-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="deal-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'amount')->textInput() ?>
        
        <?= $form->field($model, 'contactIds')->listBox(
            ArrayHelper::map($contacts, 'id', 'fullName'),
            [
                'multiple' => true,
                'size' => 10,
                'options' => [
                    'style' => 'height: 200px;'
                ]
            ]
        )->label('Контакты (для выбора нескольких удерживайте Ctrl)') ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>