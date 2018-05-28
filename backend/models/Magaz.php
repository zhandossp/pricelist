<?php

namespace backend\models;


class Magaz extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'magaz';
    }
    public function rules()
    {
        return [
            [['created'], 'integer'],
            [['name', 'last_edit'], 'string', 'max' => 255],
        ];
    }

}
