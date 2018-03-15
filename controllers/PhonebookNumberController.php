<?php
/**
 * Created by PhpStorm.
 * User: CSeal
 * Date: 22.12.2017
 * Time: 5:10
 */

namespace app\controllers;

use yii;
use yii\web\controller;
use app\models\PhoneNumber;
use app\models\Contact_info;

class PhonebookNumberController extends Controller
{
    public function actionIndex($contId = null){
            $post = Yii::$app->request->post('PhoneNumber');
            $contId = (isset($post['contact_info_id']) && !empty($post['contact_info_id']))? $post['contact_info_id'] : (int) $contId;
            $numberModel = new PhoneNumber();
            $numberModel->contact_info_id = $contId;
            if(!empty($post)){
                if(PhoneNumber::find()->where('contact_info_id='.$contId)->count() >= 10 ){
                    yii::$app->session->setFlash('warn','Привышен лимит номеров');
                    return $this->refresh();
                }
                $numberModel->load(Yii::$app->request->post());
                $numberModel->contact_info_id = $contId;
                $numberModel->id = null;
                if($numberModel->save()){
                    yii::$app->session->setFlash('succ', 'Номер добавлен');
                    return $this->refresh();
                }
                yii::$app->session->setFlash('warn','Ошибка записи в базу');
            }
            $contactInfo = Contact_info::find()->asArray()->where('id='.$contId)->one();
            $allNumber = PhoneNumber::find()->where('contact_info_id='.$contId)->all();
            return $this->render('list', compact('allNumber', 'contId', 'contactInfo', 'numberModel'));
    }

    public function actionDelete($id = null, $contId = null){
        if(is_null($id) || (int) $id === 0){
            if(is_null($contId) || (int) $contId === 0){
                $this->redirect(['phonebook/index']);
            }else{
                $this->redirect(['phonebook/edit', 'id'=>$contId]);
            }
        }else{
            PhoneNumber::deleteAll(['id'=>$id]);
            if(is_null($contId) || (int) $contId === 0){
                $this->redirect(['phonebook/index']);
            }else{
                $this->redirect(['phonebook-number/index', 'contId'=>$contId]);
            }
        }
    }
}