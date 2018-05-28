<?php

namespace backend\models;

use yii\db\ActiveRecord;


class Pricelist extends ActiveRecord
{

    public static function tableName() {
        return "pricelist";
    }

    public function rules()
    {
        return [
            [['id', 'image', 'article', 'title', 'description', 'availability', 'unit','price','created','last_edit'], 'safe'],
        ];
    }
}
