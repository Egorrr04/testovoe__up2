<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Управление сделками и контактами';
?>
<div class="site-index">
    <div class="container-fluid">
        <div class="row">
            <!-- Меню -->
           
            <div class="col-md-2">
                 <h3>Меню</h3>
                <div class="list-group">
                    <?= Html::a('Сделки', ['index', 'type' => 'deal'], [
                        'class' => 'list-group-item ' . ($type === 'deal' ? 'active' : ''),
                    ]) ?>
                    <?= Html::a('Контакты', ['index', 'type' => 'contact'], [
                        'class' => 'list-group-item ' . ($type === 'contact' ? 'active' : ''),
                    ]) ?>
                </div>
                
                <div class="mt-3">
                    <?= Html::a(
                        'Добавить ' . ($type === 'deal' ? 'сделку' : 'контакт'), 
                        [$type . '/create'], 
                        ['class' => 'btn btn-success']
                    ) ?>
                </div>
            </div>
            
            <!-- Список -->
            <div class="col-md-3">
                <h3>Список</h3>
                <div class="list-group">
                    <?php if ($type === 'deal'): ?>
                        <?php foreach ($deals as $deal): ?>
                            <?= Html::a($deal->name, ['index', 'type' => 'deal', 'id' => $deal->id], [
                                'class' => 'list-group-item ' . ($id == $deal->id ? 'active' : ''),
                            ]) ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php foreach ($contacts as $contact): ?>
                            <?= Html::a($contact->fullName, ['index', 'type' => 'contact', 'id' => $contact->id], [
                                'class' => 'list-group-item ' . ($id == $contact->id ? 'active' : ''),
                            ]) ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Содержимое -->
            <div class="col-md-7">
                <h3>Содержимое</h3>
                <?php if ($currentModel): ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="float-right">
                                <?= Html::a('Редактировать', [$type . '/update', 'id' => $currentModel->id], ['class' => 'btn btn-primary']) ?>
                                <?= Html::a('Удалить', [$type . '/delete', 'id' => $currentModel->id], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </div>
                            <h4>
                                <?= $type === 'deal' ? $currentModel->name : $currentModel->fullName ?>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <?php if ($type === 'deal'): ?>
                                        <tr>
                                            <th width="30%">ID сделки</th>
                                            <td><?= $currentModel->id ?></td>
                                        </tr>
                                        <tr>
                                            <th>Наименование</th>
                                            <td><?= $currentModel->name ?></td>
                                        </tr>
                                        <tr>
                                            <th>Сумма</th>
                                            <td><?= $currentModel->amount ?></td>
                                        </tr>
                                        <tr>
                                            <th>Контакты</th>
                                            <td>
                                                <?php if ($currentModel->contacts): ?>
                                                    <table class="table table-sm">
                                                        <?php foreach ($currentModel->contacts as $contact): ?>
                                                            <tr>
                                                                <td width="30%">id контакта: <?= $contact->id ?></td>
                                                                <td><?= $contact->fullName ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </table>
                                                <?php else: ?>
                                                    Нет контактов
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <th width="30%">ID контакта</th>
                                            <td><?= $currentModel->id ?></td>
                                        </tr>
                                        <tr>
                                            <th>Имя</th>
                                            <td><?= $currentModel->first_name ?></td>
                                        </tr>
                                        <tr>
                                            <th>Фамилия</th>
                                            <td><?= $currentModel->last_name ?></td>
                                        </tr>
                                        <tr>
                                            <th>Сделки</th>
                                            <td>
                                                <?php if ($currentModel->deals): ?>
                                                    <table class="table table-sm">
                                                        <?php foreach ($currentModel->deals as $deal): ?>
                                                            <tr>
                                                                <td width="30%">id сделки: <?= $deal->id ?></td>
                                                                <td><?= $deal->name ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </table>
                                                <?php else: ?>
                                                    Нет сделок
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        Выберите элемент из списка для просмотра деталей
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>