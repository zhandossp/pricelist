<?php
namespace backend\controllers;

use backend\components\Helpers;
use backend\models\Profiles;
use backend\models\Bots;
use Yii;
use yii\web\Controller;
use yii\web\Response;


class AccountController extends Controller
{
    public function actionSetpassword()
    {
        if (Yii::$app->request->isAjax) {
            if (Helpers::CheckAuth("check", null)) {
                $check_password = Profiles::find()->where(['id' => Yii::$app->session->get('profile_id'), 'password' => md5($_POST['password'])])->one();
                if ($check_password != null) {
                    $check_password->password = md5($_POST['newpass']);
                    if ($check_password->save()) {
                        $response['message'] = "Пароль успешно изменен, требуется перезайти.";
                        $response['type'] = "success";
                    } else {
                        $response['message'] = "Неизвестная ошибка, попробуйте позже.";
                        $response['type'] = "error";
                    }
                } else {
                    $response['message'] = "Текущий пароль неверный.";
                    $response['type'] = "warning";
                }
            } else {
                $response['message'] = "Сессия устарела, перезайдите.";
                $response['type'] = "information";
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $response;
        }
    }

    public function actionSetinformation()
    {
        if (Yii::$app->request->isAjax) {
            if (Helpers::CheckAuth("check", null)) {
                $profile = Profiles::find()->where(['id' => Yii::$app->session->get('profile_id')])->one();
                if ($profile != null) {
                    $profile->attributes = $_POST['Information'];
                    $profile->email = $profile->email;
                    $profile->last_edit = time();
                    if ($profile->save()) {
                        $response['message'] = "Данные успешно сохранены.";
                        $response['type'] = "success";
                        $response['last_edit'] = "Последнее изменение: ".date("d.m.Y", $profile->last_edit);
                    } else {
                        $response['message'] = "Неизвестная ошибка, попробуйте позже.";
                        $response['type'] = "error";
                    }
                }
            } else {
                $response['message'] = "Сессия устарела, перезайдите.";
                $response['type'] = "information";
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $response;
        }
    }

    public function actionAddbot() {
        if (Yii::$app->request->isAjax) {
            if (Helpers::CheckAuth("check", null)) {
                $model = new Bots();
                $model->attributes = $_POST['Bot'];
                $model->created_at = time();
                $model->parent_id = Yii::$app->session->get('profile_id');
                if ($_POST['Bot']['tarif'] == "FREE") {
                    $model->pay_date = time() + (86400 * 7);
                    $model->status = 2;
                }
                if ($model->save()) {
                    $response['message'] = "Данные успешно изменены.";
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
