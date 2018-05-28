<?php

namespace backend\models;


class Feedback extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'feedback';
    }
    public function rules()
    {
        return [
            [['created'], 'integer'],
            [['name', 'last_edit','phone'], 'string', 'max' => 255],
        ];
    }

}
