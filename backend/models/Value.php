<?php

namespace backend\models;


class Value extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'value';
    }
    public function rules()
    {
        return [
            [['created','sale','filter_id'], 'integer'],
            [['filter_title', 'last_edit','value'], 'string', 'max' => 255],
        ];
    }

}
