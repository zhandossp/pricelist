<?php
    namespace backend\controllers;
    use Yii;
    use backend\models\Dealers;
    use backend\components\SendMail;
    use yii\web\Controller;
    use yii\web\Response;
    use backend\components\Helpers;

    class AdminsController extends Controller
    {
        public function actionAction() {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    $id = $_POST['id'];
                    if ($id != null) {
                        $model = Dealers::find()->where(['id' => $id])->one();
                    } else {
                        $model = new Dealers();
                    }
                    $check = Dealers::find()->where(['email' => $_POST['Information']['email']])->one();
                    $good = 0;
                    if ($id != null) {
                        if ($model->email == $_POST['Information']['email']) {
                            $good = 1;
                        } else {
                            if ($check == null) {
                                $good = 1;
                            } else {
                                $good = 0;
                            }
                        }
                    } else {
                        if ($check == null) {
                            $good = 1;
                        }
                    }

                    if ($good == 1) {

                        $model->attributes = $_POST['Information'];
                        $model->role = "admin";
                        $model->last_edit = date("d/m/Y H:i:s", time());
                        if ($id == null) {
                            $today = getdate();
                            $model->created = strtotime($today['mday'].".".$today['mon'].".".$today['year']);
                        }
                        if ($_POST['password'] != null) {
                            $password = $_POST['password'];
                            $model->password = md5($password);
                        } else if ($id == null) {
                            $password = Helpers::GeneratePassword();
                            $model->password = md5($password);
                        }
                        if ($model->save()) {
                            if ($id != null) {
                                $response['message'] = "Данные успешно изменены";
                            } else {
                                SendMail::SendRegistration($_POST['Information']['email'], $password, 'администратор');
                                $response['message'] = "Администратор успешно добавлен";
                            }
                            $response['type'] = "success";
                        } else {
                            $response['message'] = "Неизвестная ошибка, попробуйте позже.";
                            $response['type'] = "error";
                        }
                    } else {
                        $response['message'] = "Данный E-Mail занят, укажите другой";
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
