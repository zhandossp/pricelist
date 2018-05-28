<?php
namespace backend\controllers;
use Yii;
use backend\models\News;
use yii\web\Controller;
use yii\web\Response;
use backend\components\Helpers;
use Imagine\Image\ManipulatorInterface;
use yii\imagine\Image;
use yii\web\UploadedFile;

class NewsController extends Controller
{
    public function actionAction() {
        if (Yii::$app->request->isAjax) {
            if (Helpers::CheckAuth("check", null)) {
                $id = $_POST['id'];
                if ($id != null) {
                    $model = News::find()->where(['id' => $id])->one();
                } else {
                    $model = new News();
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
                    $path = 'uploads/news/';
                    Image::thumbnail($image->tempName, 300, 300, ManipulatorInterface::THUMBNAIL_OUTBOUND)
                        ->save($path . $name, ['quality' => 80]);
                    $model->image = $name;
                }
                if ($model->save()) {
                    if ($id != null) {
                        $response['message'] = "Данные успешно изменены";
                    } else {
                        $response['message'] = "Новость успешно добавлена";
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
