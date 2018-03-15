<?php
namespace backend\controllers;

use backend\models\Dealers;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use backend\components\Helpers;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function actionIndex()
    {

        return $this->render('html');
    }

    public function actionAuthentication() {
        Helpers::CheckAuth("redirect", "/profile/");
        return $this->render('index');
    }

    public function actionRegistration() {
        if (Yii::$app->request->isAjax) {
            $profile = Dealers::find()->where(['email' => $_POST['email']])->one();
            if ($profile == null) {
                $generate_password = Helpers::GeneratePassword();

                $add_account = new Dealers();
                $add_account->email = $_POST['email'];
                $add_account->password = md5($generate_password);
                $add_account->status = 0;
                if ($add_account->save()) {
                    $request['message'] = "На Ваш E-Mail адрес отправлены данные для входа";
                    $request['type'] = "success";
                } else {
                    $request['message'] = "Неизвестная ошибка, попробуйте позже";
                    $request['type'] = "error";
                }
            } else {
                $request['message'] = "Данный E-Mail адрес занят, используйте другой";
                $request['type'] = "warning";
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $request;
        }
    }

    public function actionLogin() {
        if (Yii::$app->request->isAjax) {
            $profile = Dealers::find()->where(['email' => $_POST['email'], 'password' => md5($_POST['password'])])->one();
            if ($profile != null AND $profile->status == 1) {
                $request['message'] = "Вы успешно авторизовались";
                $request['type'] = "success";

                Yii::$app->session->set('profile_auth', 'OK');
                Yii::$app->session->set('profile_id', $profile->id);
                Yii::$app->session->set('profile_ip', $_SERVER['REMOTE_ADDR']);
                Yii::$app->session->set('profile_role', $profile->role);
                Yii::$app->session->set('profile_fio', $profile->fio);
                Yii::$app->session->set('profile_avatar', $profile->avatar);
                Yii::$app->session->set('profile_access', $profile->access);

                $profile->last_ip = $_SERVER['REMOTE_ADDR'];
                if ($profile->status == 0) {
                    $profile->status = 1;
                }
                $profile->save();
            } else {
                if ($profile->status != 1 AND $profile != null) {
                    $request['message'] = "Ваш кабинет заблокирован!\nОбратитесь к администратору";
                    $request['type'] = "error";
                } else {
                    $request['message'] = "Логин или пароль неверный";
                    $request['type'] = "error";
                }
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $request;
        }
    }

    public function actionLogout()
    {
        Yii::$app->session->set('profile_auth', 'NONE');
        Yii::$app->session->set('profile_id', 0);
        Yii::$app->session->set('profile_ip', null);
        Yii::$app->session->set('profile_role', null);
        Yii::$app->session->set('navigation_back',  null);
        return $this->goHome();
    }

    public function actionDelete() {
        if (Yii::$app->request->isAjax) {
            $id = $_POST['id'];
            $table = $_POST['table'];
            if ($id != null) {
                Yii::$app->db->createCommand()->delete($table, ['id' => $id])->execute();
                $request['message'] = "Удаление прошло успешно";
                $request['type'] = "success";
            } else {
                $request['message'] = "Неизвестная ошибка, попробуйте позже";
                $request['type'] = "error";
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $request;
        }
    }

}
