<?php

namespace backend\models;

use yii\db\ActiveRecord;


class Associate extends ActiveRecord
{

    public static function tableName() {
        return "associate";
    }

    public function rules()
    {
        return [
            [['email', 'password','role', 'position', 'fio', 'phone', 'last_edit', 'department', 'created','avatar','status'], 'safe'],
        ];
    }
}
