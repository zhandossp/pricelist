<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "subcategories".
 *
 * @property string $subcategory_id
 * @property string $subcategory_name
 * @property string $section_id
 * @property string $section_name
 * @property string $category_id
 * @property string $category_name
 */
class Subcategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subcategories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['section_id', 'category_id', 'created', 'status', 'weight'], 'integer'],
            [['name', 'section_name', 'category_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subcategory_id' => 'Subcategory ID',
            'subcategory_name' => 'Subcategory Name',
            'section_id' => 'Section ID',
            'section_name' => 'Section Name',
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
        ];
    }

    public function fields()
    {
        $fields = parent::fields();

        unset($fields['category_name'], $fields['section_name']);

        return $fields;
    }

    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }
    public function getSection()
    {
        return $this->hasOne(Sections::className(), ['id' => 'section_id'])
            ->viaTable(Categories::tableName(), ['id' => 'category_id']);
    }

}
