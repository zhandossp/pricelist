<?php

namespace backend\models;


class Tovar extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'tovar';
    }
    public function rules()
    {
        return [
            [['created'], 'integer'],
            [['name', 'last_edit','parrent_id'], 'string', 'max' => 255],
        ];
    }

}
