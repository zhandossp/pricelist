<?php
    namespace backend\controllers;
    use api\models\MobileUser;
use Yii;
    use backend\models\Shops;
    use yii\web\Controller;
    use yii\web\Response;
    use backend\components\Helpers;
    use Imagine\Image\ManipulatorInterface;
    use yii\imagine\Image;
    use yii\web\UploadedFile;

    class UsersController extends Controller
    {
        public function actionAction() {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    $id = $_POST['id'];
                    if ($id != null) {
                        $model = MobileUser::find()->where(['id' => $id])->one();
                    } else {
                        $model = new MobileUser();
                    }
                    $model->attributes = $_POST['Information'];
                    $model->last_edit = date("d/m/Y H:i:s", time());

                    if ($model->save()) {
                        if ($id != null) {
                            $response['message'] = "Данные успешно изменены";
                        } else {
                            $response['message'] = "Пользователь успешно добавлен";
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
