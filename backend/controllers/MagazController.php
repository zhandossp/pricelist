<?php
namespace backend\controllers;
use backend\models\Categories;
use backend\models\Pricelist;
use backend\models\Sections;;
use backend\models\Subcategories;
use Yii;
use yii\web\Controller;


class MagazController extends Controller
{
    public function actionFilters() {
        $id = $_GET['id'];
        $model = Sections::find()->where(['id'=>$id])->asArray()->all();
        foreach ($model as $key => $qwe) {
            $value = Categories::find()->where(['section_id' => $qwe['id']])->asArray()->all();
            foreach ($value as $kez => $qwq) {
                $val = Subcategories::find()->where(['category_id' => $qwq['id']])->asArray()->all();
                $value[$kez]['sales'] = $val;
            }
            $model[$key]['values'] = $value;

        }

        echo json_encode($model );
        die;
    }
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent :: beforeAction($action);
    }
    public function actionProducts() {
        $this->enableCsrfValidation = false;
        $id = $_GET['id'];
        $model = Pricelist::find()->where(['id' => $id])->asArray()->one();
        echo json_encode($model );
        die;
    }
}
?>
