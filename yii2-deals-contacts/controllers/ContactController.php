<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Contact;
use app\models\Deal;

class ContactController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $model = new Contact();
        $deals = Deal::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['site/index', 'type' => 'contact', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'deals' => $deals,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $deals = Deal::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['site/index', 'type' => 'contact', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'deals' => $deals,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['site/index', 'type' => 'contact']);
    }

    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}