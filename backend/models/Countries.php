<?php

namespace backend\models;


class Countries extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'countries';
    }
    public function rules()
    {
        return [
            [['created', 'status', 'country_id'], 'integer'],
            [['name', 'last_edit'], 'string', 'max' => 255],
        ];
    }

}
