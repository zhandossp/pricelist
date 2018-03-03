<?php
namespace backend\controllers;

use backend\components\Helpers;
use backend\models\Params;
use backend\models\Dealers;
use backend\models\Products;
use backend\models\Shops;
use backend\models\Sections;
use backend\models\Categories;
use backend\models\Subcategories;
use yii\web\Response;

use Yii;
use yii\web\Controller;



class LoadajaxController extends Controller
{
    public function actionGetpage() {
        if (Yii::$app->request->isAjax) {
            if (Helpers::CheckAuth("check", null)) {
                $page = $_POST['page'];
                Yii::$app->session->set('navigation_page', $page);
                Yii::$app->response->cookies->add(new \yii\web\Cookie([
                    'name' => 'back',
                    'value' => $page
                ]));
                if (Helpers::GetPageAccess($page)) {
                    return $this->renderPartial('/tables/' . $page . '/index', array('model' => null, 'page' => $page));
                } else {
                    return $this->renderPartial('/system/access-denied');
                }
            } else {
                return 101;
            }
        }
    }

    public function actionGetaction() {
        if (Yii::$app->request->isAjax) {
            if (Helpers::CheckAuth("check", null)) {
                if ($_POST['id'] != null) {
                    $id = $_POST['id'];
                } else {
                    $id = 0;
                }
                $security = true;
                $page = $_POST['page'];
                if ($page == "dealers/form-dealer") {
                    $model = Dealers::find()->where(['id' => $id])->one();
                } else if ($page == "admins/form-admin") {
                    $model = Dealers::find()->where(['id' => $id])->one();
                } else if ($page == "sellers/form-seller") {
                    $model = Dealers::find()->where(['id' => $id])->one();
                } else if ($page == "shops/form-shop") {
                    $model = Shops::find()->where(['shop_id' => $id])->one();
                } else if ($page == "products/form-product") {
                    $model = Products::find()->where(['id' => $id])->one();
                } else if ($page == "sections/form-section") {
                    $model = Sections::find()->where(['id' => $id])->one();
                } else if ($page == "categories/form-category") {
                    $model = Categories::find()->where(['id' => $id])->one();
                } else if ($page == "subcategories/form-subcategory") {
                    $model = Subcategories::find()->where(['id' => $id])->one();
                } else if ($page == "params/form-param") {
                    $model = Params::find()->where(['id' => $id])->one();
                } else {
                    $model = null;
                }

                Yii::$app->session->set('navigation_page', $page);
                if ($model != null) {
                    return $this->renderPartial('/tables/' . $page, array("model" => $model, "security" => $security));
                } else {
                    return $this->renderPartial('/tables/' . $page, array("security" => $security, 'model' => null));
                }
            } else {
                return 101;
            }
        }
    }

    public function actionFiltrlink() {
        if (Yii::$app->request->isAjax) {
            if (Helpers::CheckAuth("check", null)) {
                $id = $_POST['id'];
                $page = $_POST['page'];
                $array = Yii::$app->session->get('filtr');
                if ($page == "sellers") {
                    $array[$page]['rod_id'] = $id;
                } else if ($page == "shops") {
                    $array[$page]['user_id'] = $id;
                } else if ($page == "products") {
                    $array[$page]['shop_id'] = $id;
                }
                Yii::$app->session->set('filtr', $array);
                $response['type'] = "success";
            } else {
                $response['type'] = "information";
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $response;
        }
    }

}
