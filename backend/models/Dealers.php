<?php

namespace backend\models;

use yii\db\ActiveRecord;


class Dealers extends ActiveRecord
{

    public static function tableName() {
        return "dealers";
    }

    public function rules()
    {
        return [
            [['email', 'password', 'rod_id', 'name', 'fio', 'phone', 'last_edit', 'role', 'status', 'created', 'bank', 'bin', 'u_address', 'f_address', 'iik', 'bik', 'position', 'company', 'seller_type', 'city'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-Mail адрес',
            'password' => 'Пароль',
            'fio' => 'Представитель',
            'last_name' => 'Фамилия',
            'status' => 'Активация',
            'last_edit' => 'Последнее изменение',
            'last_ip' => 'IP Адрес',
            'role' => 'Права доступа',
        ];
    }
}
