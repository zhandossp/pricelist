<?php

namespace backend\models;

use yii\db\ActiveRecord;


class News extends ActiveRecord
{

    public static function tableName() {
        return "news";
    }

    public function rules()
    {
        return [
            [['name','title', 'description','last_edit','created', 'image', 'status','content','keywords','category_id','category_title'], 'safe'],
        ];
    }
}
