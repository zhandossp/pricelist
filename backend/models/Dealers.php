<?php

namespace backend\models;

use yii\db\ActiveRecord;


class Dealers extends ActiveRecord
{

    public static function tableName() {
        return "dealers";
    }

    public function rules()
    {
        return [
            [['email', 'password', 'rod_id', 'name', 'fio', 'phone', 'last_edit', 'role', 'status', 'created', 'bank', 'bin', 'u_address', 'f_address', 'iik', 'bik', 'position', 'company', 'seller_type', 'city'], 'safe'],
        ];
    }
}
