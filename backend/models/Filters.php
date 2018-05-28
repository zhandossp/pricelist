<?php

namespace backend\models;


class Filters extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'filters';
    }
    public function rules()
    {
        return [
            [['created'], 'integer'],
            [['title', 'last_edit'], 'string', 'max' => 255],
        ];
    }

}
