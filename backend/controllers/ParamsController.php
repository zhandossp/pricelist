<?php
    namespace backend\controllers;
    use Yii;
    use backend\models\Params;
    use yii\web\Controller;
    use yii\web\Response;
    use backend\components\Helpers;

    class ParamsController extends Controller
    {
        public function actionAction() {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    $id = $_POST['id'];
                    if ($id != null) {
                        $model = Params::find()->where(['id' => $id])->one();
                    } else {
                        $model = new Params();
                    }
                    $model->attributes = $_POST['Information'];
                    $model->last_edit = date("d/m/Y H:i:s", time());
                    if ($id == null) {
                        $today = getdate();
                        $model->created = strtotime($today['mday'] . "." . $today['mon'] . "." . $today['year']);
                    }

                    if ($model->save()) {
                        if ($id != null) {
                            $response['message'] = "Данные успешно изменены";
                        } else {
                            $response['message'] = "Характеристика успешно добавлена";
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

        public function actionGetparams() {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    $model = Params::find()->where(['status' => '1'])->all();
                    $res = null;
                    foreach ($model as $value) {
                        $res .= '<option value = "'.$value->id.'">'.$value->name.'</option>';
                    }
                    echo $res;
                }
            }
        }
    }
?>
