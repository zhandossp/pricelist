<?php

namespace backend\models;


class Category extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }
    public function rules()
    {
        return [
            [['created', 'status'], 'integer'],
            [['name', 'last_edit'], 'string', 'max' => 255],
        ];
    }

}
                