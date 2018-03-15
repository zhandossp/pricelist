<?php
namespace backend\controllers;

use backend\components\Helpers;
use backend\models\Dealers;
use backend\models\Profiles;
use backend\models\Bots;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use Imagine\Image\ManipulatorInterface;
use yii\imagine\Image;
use yii\web\UploadedFile;


class AccountController extends Controller
{
    public function actionSetpassword()
    {
        if (Yii::$app->request->isAjax) {
            if (Helpers::CheckAuth("check", null)) {
                $check_password = Dealers::find()->where(['id' => Yii::$app->session->get('profile_id'), 'password' => md5($_POST['password'])])->one();
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
                $profile = Dealers::find()->where(['id' => Yii::$app->session->get('profile_id')])->one();
                if ($profile != null) {
                    $profile->attributes = $_POST['Information'];
                    $profile->email = $profile->email;
                    $profile->last_edit = date("d/m/Y H:i:s", time());

                    $image = UploadedFile::getInstanceByName('avatar');
                    if ($image != null) {
                        $rand = rand(1, 9999);
                        $name = Helpers::GetTransliterate($profile->fio) . '_' . uniqid() . '_' . $rand . '_' . time() . '.' . $image->extension;
                        $path = 'uploads/avatars/';
                        Image::thumbnail($image->tempName, 100, 100, ManipulatorInterface::THUMBNAIL_OUTBOUND)
                            ->save($path . $name, ['quality' => 80]);
                        $profile->avatar = $name;
                        Yii::$app->session->set('profile_avatar', $name);
                    }

                    if ($profile->save()) {
                        $response['message'] = "Данные успешно сохранены.";
                        $response['type'] = "success";
                        $response['last_edit'] = "Последнее изменение: ".$profile->last_edit;
                        if ($name != null) {
                            $response['avatar'] = $name;
                        }
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

}
