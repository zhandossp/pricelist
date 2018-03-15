<?php

namespace backend\models;


class Cities extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'cities';
    }
    public function rules()
    {
        return [
            [['created', 'status', 'country_id'], 'integer'],
            [['name', 'last_edit'], 'string', 'max' => 255],
            [['faq_email', 'connect_email', 'connect_phone', 'connect_whatsapp'], 'string', 'max' => 255],
        ];
    }

}
