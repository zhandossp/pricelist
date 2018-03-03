<?php

namespace backend\models;


class Params extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'params';
    }
    public function rules()
    {
        return [
            [['created', 'status'], 'integer'],
            [['name', 'last_edit'], 'string', 'max' => 255],
        ];
    }

}
