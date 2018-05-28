<?php

namespace backend\models;


class Keys extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'keys';
    }
    public function rules()
    {
        return [
            [['created'], 'integer'],
            [['key', 'last_edit'], 'string', 'max' => 255],
        ];
    }

}
