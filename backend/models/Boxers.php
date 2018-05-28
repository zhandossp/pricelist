<?php

namespace backend\models;


class Boxers extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'boxers';
    }
    public function rules()
    {
        return [
            [['created', 'status'], 'integer'],
            [['name', 'last_edit','title','ava'], 'string', 'max' => 255],
        ];
    }

}
