<?php
namespace backend\controllers;
use backend\models\Categories;
use backend\models\ProductsList;
use backend\models\Subcategories;
use Yii;
use backend\models\Products;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use backend\components\Helpers;
use Imagine\Image\ManipulatorInterface;
use yii\imagine\Image;


    class ProductsController extends Controller
    {
        public function actionAction() {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    $id = $_POST['id'];
                    if ($id != null) {
                        $model = Products::find()->where(['id' => $id])->one();
                    } else {
                        $model = new Products();
                    }
                    $model->attributes = $_POST['Information'];



                    $array_filtr = Yii::$app->session->get('filtr');
                    if ($array_filtr['products']['shop_id'] != null) {
                        $model->shop_id = $array_filtr['products']['shop_id'];
                    } else {
                        $model->shop_id = $_POST['shop_id'];
                    }

                    $model->seller_id = $model->seller->id;
                    $model->dealer_id = $model->seller->rod_id;


                    $model->last_edit = date("d/m/Y H:i:s", time());

                    if ($id == null) {
                        $today = getdate();
                        $model->created = strtotime($today['mday'] . "." . $today['mon'] . "." . $today['year']);
                    }

                    $sizes = str_replace(" ", "", $_POST['sizes']);
                    $ex_sizes = explode(",", $sizes);
                    $model->sizes = json_encode($ex_sizes);

                    if ($_POST['parameter'] != null) {
                        $par = array();
                        foreach ($_POST['parameter']['name'] as $key => $value) {
                            $par[$value] = $_POST['parameter']['value'][$key];
                        }
                        $model->params = json_encode($par);
                    }

                    $model->colors = json_encode($_POST['colors']);

                    $model->images = UploadedFile::getInstances($model, 'images');
                    if(is_array($model->images) && !empty($model->images)) {
                        foreach ($model->images as $image) {
                            $rand = rand(1, 9999);
                            $name = Helpers::GetTransliterate($model->product_name).'_'.uniqid().'_'.$rand.'_'.time().'.'.$image->extension;
                            $path = 'uploads/products/';
                            $imagePaths[] = $name;
                            $imageMinPaths[] = $name;
                            Image::thumbnail($image->tempName, 300, 300, ManipulatorInterface::THUMBNAIL_OUTBOUND)
                                ->save($path.'min/'.$name, ['quality' => 80]);
                            Image::thumbnail($image->tempName, 600, 600, ManipulatorInterface::THUMBNAIL_OUTBOUND)
                                ->save($path.'full/'.$name, ['quality' => 80]);
                        }
                        $model->product_imgs = json_encode($imagePaths);
                        $model->product_main_img = $imagePaths[0];
                    }


                    if ($model->save()) {

                        $product_list = ProductsList::find()->where(['product_id' => $id])->one();
                        if ($product_list != null) {
                            $product_list->section_id = $_POST['section'];
                            $product_list->category_id = $_POST['category'];
                            $product_list->subcategory_id = $_POST['subcategory'];
                            $product_list->product_list_count = $_POST['product_list_count'];
                            $product_list->product_list_status = $_POST['Information']['status'];
                        } else {
                            $product_list = new ProductsList();
                            $product_list->product_id = $model->id;
                            $product_list->section_id = $_POST['section'];
                            $product_list->category_id = $_POST['category'];
                            $product_list->subcategory_id = $_POST['subcategory'];
                            $product_list->product_list_count = $_POST['product_list_count'];
                            $product_list->product_list_status = $_POST['Information']['status'];
                        }
                        $product_list->save();

                        if ($id != null) {
                            $response['message'] = "Данные успешно изменены";
                        } else {
                            $response['message'] = "Товар успешно добавлен";
                        }
                        $response['type'] = "success";
                    } else {
                        $response['message'] = "Неизвестная ошибка, попробуйте позже.";
                        $response['type'] = "error";
                    }
                } else {
                    $response['message'] = "Сессия устарела, перезайдите.";
                    $response['type'] = "information";
                }
                Yii::$app->response->format = Response::FORMAT_JSON;
                return $response;
            }
        }
        public function actionDeleteimgs() {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    $model_id = $_POST['model_id'];
                    $img = $_POST['key'];
                    $model = Products::find()->where(['id' => $model_id])->one();
                    $images = json_decode($model->product_imgs, true);
                    $key = array_search($img, $images);
                    unset($images[$key]);
                    unlink("uploads/products/full/".$img);
                    unlink("uploads/products/min/".$img);
                    $model->product_imgs = json_encode($images);
                    $model->save();
                    //print_r($images);
                    echo 1;
                }
            }
        }

        public function actionSection() {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    $response['value'] = Html::dropDownList('category', null,
                        ArrayHelper::map(Categories::find()->where(['section_id' => $_POST['id']])->all(), 'id', 'name'));
                    $response['type'] = "success";
                    $response['next'] = Categories::find()->where(['section_id' => $_POST['id']])->one()->id;
                } else {
                    $response['message'] = "Сессия устарела, перезайдите.";
                    $response['type'] = "information";
                }
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $response;
        }
        public function actionCategory() {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    $response['value'] = Html::dropDownList('subcategory', null,
                        ArrayHelper::map(Subcategories::find()->where(['category_id' => $_POST['id']])->all(), 'id', 'name'));
                    $response['type'] = "success";
                } else {
                    $response['message'] = "Сессия устарела, перезайдите.";
                    $response['type'] = "information";
                }
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $response;
        }
    }
?>
