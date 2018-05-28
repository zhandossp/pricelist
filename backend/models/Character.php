<?php

namespace backend\models;


class Character extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'character';
    }
    public function rules()
    {
        return [
            [['created'], 'integer'],
            [['name', 'last_edit','dad_id'], 'string', 'max' => 255],
        ];
    }

}
