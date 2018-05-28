<?php
namespace backend\controllers;
    use Yii;
    use backend\models\Boxers;
    use yii\web\Controller;
    use yii\web\Response;
    use backend\components\Helpers;
    use Imagine\Image\ManipulatorInterface;
    use yii\imagine\Image;
    use yii\web\UploadedFile;

class BoxersController extends Controller
{
    public function actionAction() {
        if (Yii::$app->request->isAjax) {
            if (Helpers::CheckAuth("check", null)) {
                $id = $_POST['id'];
                if ($id != null) {
                    $model = Boxers::find()->where(['id' => $id])->one();
                } else {
                    $model = new Boxers();
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
                    $path = 'uploads/boxers/';
                    Image::thumbnail($image->tempName, 300, 300, ManipulatorInterface::THUMBNAIL_OUTBOUND)
                        ->save($path . $name, ['quality' => 80]);
                    $model->ava = $name;
                }
                if ($model->save()) {
                    if ($id != null) {
                        $response['message'] = "Данные успешно изменены";
                    } else {
                        $response['message'] = "Объем успешно добавлен";
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
