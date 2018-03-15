<?php
/**
 * Created by PhpStorm.
 * User: CSeal
 * Date: 21.12.2017
 * Time: 0:52
 */

namespace app\models;


use yii\db\ActiveRecord;

class Contact_info extends ActiveRecord
{
//  Связь join
  public function getPhonesNumber(){
      return $this->hasMany(PhoneNumber::className(), ['contact_info_id' => 'id']);
  }

    public function attributeLabels()
    {
        return [
            'name'=>'Имя',
            'surname'=>'Фамилия',
            'patronumic'=>'Отчество'
        ];
    }

  public function rules(){
        return [
            ['name', 'required'],
            [['name', 'surname', 'patronumic'], 'string', 'min' => 3,'tooShort'=>'А чего не "Эй ты, как там тебя?! "'],
            [['name', 'surname', 'patronumic'], 'string', 'max' => 18, 'tooLong'=>'Может как нибудь покороче?!'],
            ['id', 'safe']
        ];
    }

}