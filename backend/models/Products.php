<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property string $product_id
 * @property string $product_name
 * @property string $product_main_img
 * @property string $product_imgs
 * @property integer $product_rating
 * @property string $product_price
 * @property string $product_parameters
 * @property string $product_description
 */
class Products extends \yii\db\ActiveRecord
{
    public $images;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_name', 'product_price', 'shop_id'], 'required'],
            [['product_imgs', 'product_imgs_min', 'product_description', 'last_edit'], 'string'],
            [['product_price', 'status', 'created', 'dealer_id', 'seller_id'], 'integer'],
            [['product_rating'], 'number'],
            [['product_name', 'product_main_img', 'sizes'], 'string', 'max' => 255],
            [['product_parameters', 'colors', 'params'], 'string', 'max' => 2000],
           // [['images'], 'file', 'maxFiles' => 10, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_name' => 'Product Name',
            'product_main_img' => 'Product Main Img',
            'product_imgs' => 'Product Imgs',
            'product_imgs_min' => 'Product Imgs Min',
            'product_rating' => 'Product Rating',
            'product_price' => 'Product Price',
            'product_parameters' => 'Product Parameters',
            'product_description' => 'Product Description',
        ];
    }

    public function getSeller()
    {
        return $this->hasOne(Dealers::className(), ['id' => 'user_id'])
            ->viaTable(Shops::tableName(), ['shop_id' => 'shop_id']);
    }
}
