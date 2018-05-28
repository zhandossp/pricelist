<?php
namespace backend\controllers;
use backend\models\Magaz;
use backend\models\Tovar;
use backend\models\Keys;
use backend\models\Character;
use backend\models\Under_char;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use backend\components\Helpers;

class XxxtenController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionAction()
    {

        // Yii::$app->response->format = Response::FORMAT_JSON;
        $model = Magaz::find()->asArray()->all();
        foreach ($model as $key => $qwe) {

            $tovar = Tovar::find()->where(['parrent_id' => $qwe['id']])->asArray()->all();
            foreach ($tovar as $kez => $zxc) {
                $harak = Character::find()->where(['dad_id' => $zxc['id']])->asArray()->all();
                foreach ($tovar as $kep => $asd) {
                    $under_harak = Under_char::find()->where(['grand_id' => $asd['id']])->asArray()->all();
                    $harak[$kep]['harak'] = $under_harak;
                }
                $tovar[$kez]['harak'] = $harak;
            }
            $model[$key]['products'] = $tovar;

        }

        /*echo '<pre>';
        print_r($model);
        echo '</pre>';*/
        echo json_encode($model );
    }

}
?>
