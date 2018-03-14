<?php
namespace backend\controllers;
use backend\models\Categories;
use backend\models\Sections;
use backend\models\Subcategories;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use backend\components\Helpers;
use Imagine\Image\ManipulatorInterface;
use yii\imagine\Image;
use yii\web\UploadedFile;

class SectionsController extends Controller
    {
        public function actionAction() {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    $id = $_POST['id'];
                    if ($id != null) {
                        $model = Sections::find()->where(['id' => $id])->one();
                    } else {
                        $model = new Sections();
                    }

                    $model->attributes = $_POST['Information'];
                    $model->last_edit = date("d/m/Y H:i:s", time());

                    if ($id == null) {
                        $today = getdate();
                        $model->created = strtotime($today['mday'] . "." . $today['mon'] . "." . $today['year']);
                    }

                    $image = UploadedFile::getInstance($model, 'image');
                    if ($image != null) {
                        $rand = rand(1, 9999);
                        $name = Helpers::GetTransliterate($model->name) . '_' . uniqid() . '_' . $rand . '_' . time() . '.' . $image->extension;
                        $path = 'uploads/sections/';
                        Image::thumbnail($image->tempName, 100, 100, ManipulatorInterface::THUMBNAIL_OUTBOUND)
                            ->save($path . $name, ['quality' => 80]);
                        $model->section_image = $name;
                    }

                    if ($model->save()) {
                        if ($id != null) {
                            $response['message'] = "Данные успешно изменены";
                        } else {
                            $response['message'] = "Категория успешно добавлена";
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

        public function actionGetbody() {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    if ($_GET['type'] == "sections") {
                        $res = null;
                        $model = Categories::find()->where(['section_id' => $_GET['id']])->all();
                        foreach ($model as $key => $value) {
                            $res .= '<tr data-type = "categories" data-id="'.$value->id.'" class = "select-section"><td>' . $value->name . '</td></tr>';
                        }
                        $response['body'] = $res;
                        $response['type'] = "categories";
                        $response['get'] = $_GET;
                    } else if ($_GET['type'] == "categories") {
                        $res = null;
                        $model = Subcategories::find()->where(['category_id' => $_GET['id']])->all();
                        foreach ($model as $key => $value) {
                            $res .= '<tr data-type = "subcategories" data-id="'.$value->id.'" class = "select-section"><td>' . $value->name . '</td></tr>';
                        }
                        $response['body'] = $res;
                        $response['type'] = "subcategories";
                        $response['get'] = $_GET;
                    }
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return $response;
                }
            }
        }

        public function actionDelete()
        {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    if ($_GET['type'] == "sections") {
                        $model = Sections::find()->where(['id' => $_GET['id']])->one();
                    } else if ($_GET['type'] == "categories") {
                        $model = Categories::find()->where(['id' => $_GET['id']])->one();
                    } else if ($_GET['type'] == "subcategories") {
                        $model = Subcategories::find()->where(['id' => $_GET['id']])->one();
                    }
                    if ($model != null) {
                        if ($model->delete()) {
                            if ($_GET['type'] == "sections") {
                                Categories::deleteAll(['section_id' => $model->id]);
                                Subcategories::deleteAll(['section_id' => $model->id]);
                            } else if ($_GET['type'] == "categories") {
                                Subcategories::deleteAll(['category_id' => $model->id]);
                            }
                            $response['message'] = "Удаление прошло успешно";
                            $response['type'] = "success";
                        } else {
                            $response['message'] = "Ошибка удаления, попробуйте позже.";
                            $response['type'] = "error";
                        }
                    } else {
                        $response['message'] = "Неизвестная ошибка, попробуйте позже.";
                        $response['type'] = "error";
                    }

                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return $response;
                }
            }
        }

        public function actionAdd()
        {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    $name = $_GET['name'];
                    if ($_GET['type'] == "categories") {
                        $model = new Categories();
                        $model->name = $name;
                        $model->created = time();
                        $model->section_id = $_GET['id'];
                    } else {
                        $model = new Subcategories();
                        $model->name = $name;
                        $model->created = time();
                        $model->category_id = $_GET['id'];
                        $model->category_name = $model->category->name;
                        $model->section_id = $model->section->id;
                        $model->section_name = $model->section->name;
                    }

                    if($model->save()) {
                        $response['message'] = "Успешно добавлено";
                        $response['type'] = "success";
                        $response['id'] = $model->id;
                    } else {
                        $response['message'] = "Неизвестная ошибка, попробуйте позже.";
                        $response['type'] = "error";
                    }
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return $response;
                }
            }
        }

        public function actionEdit()
        {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    $name = $_GET['name'];
                    if ($_GET['type'] == "categories") {
                        $model = Categories::find()->where(['id' => $_GET['id']])->one();
                        $model->name = $name;
                    } else {
                        $model = Subcategories::find()->where(['id' => $_GET['id']])->one();
                        $model->name = $name;
                        $model->category_name = $model->category->name;
                        $model->section_id = $model->section->id;
                        $model->section_name = $model->section->name;
                    }
                    if($model->save()) {
                        $response['message'] = "Успешно изменено";
                        $response['type'] = "success";
                    } else {
                        $response['message'] = "Неизвестная ошибка, попробуйте позже.";
                        $response['type'] = "error";
                    }
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return $response;
                }
            }
        }
    }
?>
