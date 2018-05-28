<?php
    namespace backend\controllers;
    use backend\models\Cities;  
use Yii;
    use backend\models\Shops;
    use yii\web\Controller;
    use yii\web\Response;
    use backend\components\Helpers;
    use Imagine\Image\ManipulatorInterface;
    use yii\imagine\Image;
    use yii\web\UploadedFile;

    class ShopsController extends Controller
    {
        public function actionAction() {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    $id = $_POST['id'];
                    if ($id != null) {
                        $model = Shops::find()->where(['shop_id' => $id])->one();
                    } else {
                        $model = new Shops();
                    }
                    $model->attributes = $_POST['Information'];
                    $model->last_edit = date("d/m/Y H:i:s", time());
                    if ($id == null) {
                        $today = getdate();
                        $model->created = strtotime($today['mday'] . "." . $today['mon'] . "." . $today['year']);
                    }

                    $array_filtr = Yii::$app->session->get('filtr');
                    if ((Yii::$app->session->get('profile_role') == 'admin' OR Yii::$app->session->get('profile_role') == 'dealer' OR Yii::$app->session->get('profile_role') == 'superadmin') AND $array_filtr['shops']['user_id'] == null) {
                        $model->user_id = $_POST['rod_id'];
                    } else if ($array_filtr['shops']['user_id'] != null) {
                        $model->user_id = $array_filtr['shops']['user_id'];
                    } else {
                        $model->user_id = Yii::$app->session->get('profile_id');
                    }

                    /* ВРЕМЕННО ГОВНОКОД (магазин которому принадлежит) */
                    $title = Cities::find()->where(['id' => $_POST['Information']['city_id']])->one();
                    $model->city_title = $title->name;
                    /* ----------------- */


                    $model->dealer_id = $model->dealer->rod_id;

                    $image = UploadedFile::getInstance($model, 'image');
                    if ($image != null) {
                        $rand = rand(1, 9999);
                        $name = Helpers::GetTransliterate($model->shop_name) . '_' . uniqid() . '_' . $rand . '_' . time() . '.' . $image->extension;
                        $path = 'uploads/shops/';
                        Image::thumbnail($image->tempName, 300, 300, ManipulatorInterface::THUMBNAIL_OUTBOUND)
                            ->save($path . $name, ['quality' => 80]);
                        $model->shop_img = $name;
                    }

                    if ($model->save()) {
                        if ($id != null) {
                            $response['message'] = "Данные успешно изменены";
                        } else {
                            $response['message'] = "Магазин успешно добавлен";
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
