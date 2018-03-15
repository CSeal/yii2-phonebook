<?php
/**
 * Created by PhpStorm.
 * User: CSeal
 * Date: 21.12.2017
 * Time: 1:19
 */

namespace app\models;


use yii\db\ActiveRecord;

class PhoneNumber extends ActiveRecord
{
    //Если название модели отличается от имени тьблицы в БД
    public static function tableName(){
        return 'phone_number'; //Имя таблицы, Что указанов в базе данных
    }

    public function attributeLabels()
    {
        return ['number' => 'Номер телефона'];
    }

    public function rules(){
        return [
            ['number', 'required'],
            ['number', 'match', 'pattern' => '/^\(\d{3}\)\s?\d{3}-\d{2}-\d{2}$/', 'message'=>'Не соответствует шаблону (xxx)xxx-xx-xx'],
            [['id','contact_info_id'], 'safe']
        ];
    }

    public function getContact(){
        return $this->hasOne(Contact_info::className(),['id'=>'contact_info_id']);
    }
}