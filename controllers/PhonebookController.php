<?php
/**
 * Created by PhpStorm.
 * User: CSeal
 * Date: 20.12.2017
 * Time: 22:53
 */

namespace app\controllers;

use yii;
use yii\web\controller;
use app\models\Contact_info;
//use app\models\AddPhonebookContactForm;
use app\models\PhoneNumber;
class PhonebookController extends Controller
{
    public function actionIndex()
    {
        $phonebook  = Contact_info::find()->with('phonesNumber')->all();
        return $this->render('list', compact('phonebook'));
    }

    public function actionDelete($id = null){
        $id = (int) $id;
        if($id  !== 0){
            Contact_info::deleteAll(['id'=>$id]);
            $this->redirect(['phonebook/index']);
        }
    }

    public function actionAdd(){
        $contactCont  = new Contact_info();
        if($contactCont->load(yii::$app->request->post())){
            $contactCont->id = null;
            if($contactCont->save()){ //Данные проваледированы
                yii::$app->session->setFlash('succ', 'Данные добавлены в справочник');//Коротоая сесия. После первого вызова удаляется
                return $this->refresh();
            }else{
                yii::$app->session->setFlash('warn', 'Данные не добавлены в справочник');
            }
        }
        return $this->render('add', compact('contactCont'));
    }

    public function actionEdit($id = null){
        $contactCont = null;
        $post = Yii::$app->request->post('Contact_info');
        $id = (isset($post['id']) && !empty($post['id']))? $post['id'] : (int) $id;
         if($id === 0 || !$contactCont = Contact_info::find()->where('id ='.$id)->one()){
             $this->redirect(['phonebook/index']);
         }
         if(!empty($post)){
             if($contactCont->load(Yii::$app->request->post()) && $contactCont->save()){
                 yii::$app->session->setFlash('succ', 'Данные обновлены');
             }else{
                 yii::$app->session->setFlash('warn','Произошла ошибка при обновлении');
             }
         }
         return $this->render('edit', compact('contactCont'));
    }
}