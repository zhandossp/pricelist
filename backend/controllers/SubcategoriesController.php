<?php
    namespace backend\controllers;
    use Yii;
    use backend\models\Subcategories;
    use yii\web\Controller;
    use yii\web\Response;
    use backend\components\Helpers;



class SubcategoriesController extends Controller
    {
        public function actionAction() {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    $id = $_POST['id'];
                    if ($id != null) {
                        $model = Subcategories::find()->where(['id' => $id])->one();
                    } else {
                        $model = new Subcategories();
                    }

                    $model->attributes = $_POST['Information'];
                    $model->last_edit = date("d/m/Y H:i:s", time());

                    if ($id == null) {
                        $today = getdate();
                        $model->created = strtotime($today['mday'] . "." . $today['mon'] . "." . $today['year']);
                    }


                    $model->category_id = $_POST['rod_id'];
                    $model->category_name = $model->category->name;

                    $model->section_id = $model->section->id;
                    $model->section_name = $model->section->name;

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
    }
?>
