<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Deal;
use app\models\Contact;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $type = Yii::$app->request->get('type', 'deal');
        $id = Yii::$app->request->get('id');
        
        $deals = Deal::find()->all();
        $contacts = Contact::find()->all();
        
        $currentModel = null;
        if ($id) {
            $currentModel = $type === 'deal' 
                ? Deal::findOne($id) 
                : Contact::findOne($id);
        }
        
        return $this->render('index', [
            'type' => $type,
            'id' => $id,
            'deals' => $deals,
            'contacts' => $contacts,
            'currentModel' => $currentModel,
        ]);
    }
}