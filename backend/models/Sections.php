<?php

namespace backend\models;

use Yii;

class Sections extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'sections';
    }

    public function rules()
    {
        return [
            [['created', 'weight'], 'integer'],
            [['name', 'last_edit'], 'string', 'max' => 500],
        ];
    }

    public function attributeLabels()
    {
        return [

        ];
    }
}
