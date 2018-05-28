<?php
    namespace backend\controllers;
    use backend\models\Cities;
use Yii;
    use backend\models\Dealers;
    use yii\web\Controller;
    use yii\web\Response;
    use backend\components\Helpers;
    use backend\components\SendMail;

    class SellersController extends Controller
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

                    if ($_POST['Access'] != null) {
                        $access = null;
                        foreach ($_POST['Access'] as $key => $value) {
                            $access .= ":".$key;
                        }
                        $model->access = $access;
                    }

                    if ($good == 1) {
                        $model->attributes = $_POST['Information'];
                        $model->role = "seller";
                        $model->last_edit = date("d/m/Y H:i:s", time());
                        if ($id == null) {
                            $today = getdate();
                            $model->created = strtotime($today['mday'].".".$today['mon'].".".$today['year']);
                        }

                        $array_filtr = Yii::$app->session->get('filtr');
                        if ((Yii::$app->session->get('profile_role') == 'admin' OR Yii::$app->session->get('profile_role') == 'superadmin') AND $array_filtr['sellers']['rod_id'] == null) {
                            $model->rod_id = $_POST['rod_id'];
                        } else if ($array_filtr['sellers']['rod_id'] != null) {
                            $model->rod_id = $array_filtr['sellers']['rod_id'];
                        } else {
                            $model->rod_id = Yii::$app->session->get('profile_id');
                        }


                        /* ВРЕМЕННО ГОВНОКОД (магазин которому принадлежит) */
                        $title = Cities::find()->where(['id' => $_POST['Information']['city']])->one();
                        $model->city_title = $title->name;
                        /* ----------------- */


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
                                SendMail::SendRegistration($_POST['Information']['email'], $password, 'продавец');
                                $response['message'] = "Продавец успешно добавлен";
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
