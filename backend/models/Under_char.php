<?php

namespace backend\models;


class Under_char extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'under_char';
    }
    public function rules()
    {
        return [
            [['created'], 'integer'],
            [['name', 'last_edit','grand_id'], 'string', 'max' => 255],
        ];
    }

}
