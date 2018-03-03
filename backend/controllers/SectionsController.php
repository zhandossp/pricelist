<?php
namespace backend\controllers;
use backend\models\Categories;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use backend\components\Helpers;

class SectionsController extends Controller
    {
        public function actionGetbody() {
            if (Yii::$app->request->isAjax) {
                if (Helpers::CheckAuth("check", null)) {
                    file_put_contents("asd", $_POST['token']);
                    if ($_POST['type'] == "sections") {
                        $res = null;
                        $model = Categories::find()->all();
                        foreach ($model as $key => $value) {
                            $res .= '<tr data-type = "categories" class = "select-section"><td data-id="'.$value->id.'">' . $value->name . '</td></tr>';
                        }
                        $response['body'] = $res;
                        $response['type'] = "categories";
                    }
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return $response;
                }
            }
            echo $_POST['type'];
        }
    }
?>
