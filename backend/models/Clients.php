<?php

namespace backend\models;


class Clients extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'clients';
    }
    public function rules()
    {
        return [
            [['created', 'status'], 'integer'],
            [['name', 'last_edit','phone','ava'], 'string', 'max' => 255],
        ];
    }

}
