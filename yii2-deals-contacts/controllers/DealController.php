<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Deal;
use app\models\Contact;

class DealController extends Controller
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
        $model = new Deal();
        $contacts = Contact::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['site/index', 'type' => 'deal', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'contacts' => $contacts,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $contacts = Contact::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['site/index', 'type' => 'deal', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'contacts' => $contacts,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['site/index', 'type' => 'deal']);
    }

    protected function findModel($id)
    {
        if (($model = Deal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}