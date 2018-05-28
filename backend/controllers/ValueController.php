<?php
namespace backend\controllers;
use PHPUnit\Util\Filter;
use Yii;
use backend\models\Value;
use backend\models\Filters;
use yii\web\Controller;
use yii\web\Response;
use backend\components\Helpers;

class ValueController extends Controller
{
    public function actionAction() {
        if (Yii::$app->request->isAjax) {
            if (Helpers::CheckAuth("check", null)) {
                $id = $_POST['id'];
                if ($id != null) {
                    $model = Value::find()->where(['id' => $id])->one();
                } else {
                    $model = new Value();
                }
                $model->attributes = $_POST['Information'];
                $model->last_edit = date("d/m/Y H:i:s", time());
                if ($id == null) {
                    $today = getdate();
                    $model->created = strtotime($today['mday'] . "." . $today['mon'] . "." . $today['year']);
                }
                /* ВРЕМЕННО ГОВНОКОД (магазин которому принадлежит) */
                $title = Filters::find()->where(['id' => $_POST['Information']['filter_id']])->one();
                $model->filter_title = $title->title;
                /* ----------------- */
                
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

    public function actionFilters() {
//        $sections = Filters::find()
//            ->select(
//                '`filters`.`title`,
//                `value`.`filter_id`,
//                `value`.`id`,
//                `value`.`value`,
//                `value`.`sale`'
//            )
//            ->innerJoin('value', '`value`.`filter_id` = `filters`.`id`')
//            ->asArray()
//            ->all();
//        /*echo '<pre>';
//        print_r($sections);
//        echo '</pre>';*/
//        echo json_encode($sections);

       /* $filters = Filters::find()->asArray()->all();
        foreach ($filters as $key => $fil) {
            $arr[] = $fil;
            $value = Value::find()->where(['filter_id' => $fil['id']])->asArray()->all();
            $arr[]['values'] = $value;
           // $filters['values'] = $value;
           //=print_r($value);
           // echo $fil->id;
        }
        echo json_encode($arr);*/

        $model = Filters::find()->asArray()->all();
        foreach ($model as $key => $qwe) {
            $value = Value::find()->where(['filter_id' => $qwe['id']])->asArray()->all();
            $model[$key]['values'] = $value;

        }
        /*echo '<pre>';
        print_r($model);
        echo '</pre>';*/
        echo json_encode($model );
    }


}
?>
