<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Добавить сделку';
$this->params['breadcrumbs'][] = ['label' => 'Сделки', 'url' => ['site/index', 'type' => 'deal']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deal-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="deal-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'amount')->textInput() ?>
        
        <?= $form->field($model, 'contactIds')->listBox(
            ArrayHelper::map($contacts, 'id', 'fullName'),
            [
                'multiple' => true,
                'size' => 10, // количество отображаемых строк
                'class' => 'form-control'
            ]
        ) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>