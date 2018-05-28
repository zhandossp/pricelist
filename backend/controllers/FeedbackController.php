<?php
namespace backend\controllers;
use backend\models\Feedback;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use backend\components\Helpers;
use backend\components\SendMail;

class FeedbackController extends Controller
{
    public function actionAction() {
        if (Yii::$app->request->isAjax) {
            if (Helpers::CheckAuth("check", null)) {
                $id = $_POST['id'];
                if ($id != null) {
                    $model = Feedback::find()->where(['id' => $id])->all();
                } else {
                    $model = new Feedback();
                }

                $model->attributes = $_POST['Information'];
                $model->last_edit = date("d/m/Y H:i:s", time());
                if ($id == null) {
                    $today = getdate();
                    $model->created = strtotime($today['mday'] . "." . $today['mon'] . "." . $today['year']);
                }
                $name = $_POST['Information']['name'];
                $phone = $_POST['Information']['phone'];

                if ($model->save()) {
                    if ($id != null) {
                        $response['message'] = "Данные успешно изменены";
                    } else {
                        SendMail::SendFeedbackinf($_POST['Information']['name'],$phone);
                        $response['message'] = "Заявка успешно отправлена";
                    }

                    } else {
                        $response['message'] = "Заявка успешно отправлена";
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
?>
