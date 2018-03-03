<?php
    namespace backend\controllers;
    use Yii;
    use yii\web\Controller;
    use backend\components\Helpers;

    class CascadeController extends Controller
    {
        public function actionGetcascade() {
            if (Yii::$app->request->isAjax) {
                $cascade = Helpers::GetConfig($_POST['page'], 'cascade');
                $first = (new \yii\db\Query())
                    ->select("*")
                    ->from($cascade[0])
                    ->all();
                $res = null;
                foreach ($first as $key => $value) {
                    //$res .= '<li class = "draggable"><a class = "cascade-open closed" href = "#"><i class="icon-arrow-right32"></i> '.$value['name'].'</a>'.$this->CascadeRecursion($cascade, $cascade[1]['name'], $cascade[1]['key'], $value['id'], 1).'</li>';
                    $res .=
                        '<li class = "mt-10" id = "'.$value['id'].'">'.
                            '<div style = "padding-right:10px;" class="media-left media-middle">'.
                                '<i class="icon-dots dragula-handle"></i>'.
                            '</div>'.
                            '<div class="media-body">'.
                                '<div class="media-heading text-semibold">'.
                                    '<a href = "#" class = "cascade-open closed"><i class="icon-arrow-right32"></i> '.$value['name'].'</a><i style="font-size:1em; margin-right:5px;" class="action-button text-success-600 ml-10 cursor-pointer icon-plus2"></i></div>'.
                                    $this->CascadeRecursion($cascade, $cascade[1]['name'], $cascade[1]['key'], $value['id'], 1).
                            '</div>'.
                        '</li>';
                }
                echo $res;
            }
        }

        public function CascadeRecursion($cascade, $next_table, $key, $id, $step) {
           if ($step < count($cascade)) {
                $model = (new \yii\db\Query())
                    ->select("*")
                    ->from($next_table)
                    ->where([$key => $id])
                    ->all();
                if ($model != null) {
                    $res = '<ul class="list mt-10" style="display:none; list-style-type: none;">';
                    foreach ($model as $value) {

                        if ($step+1 < count($cascade)) {
                            $check = (new \yii\db\Query())
                                ->select("*")
                                ->from($cascade[$step + 1]['name'])
                                ->where([$cascade[$step + 1]['key'] => $value['id']])
                                ->all();
                           // if ($check != null) {
                                $res .= '<li><a href = "#" class = "cascade-open closed"><i class="icon-arrow-right32"></i> ' . $value['name'] . '</a><i style="font-size:1em; margin-right:5px;" class="action-button text-success-600 ml-10 cursor-pointer icon-plus2"></i>' . $this->CascadeRecursion($cascade, $cascade[$step + 1]['name'], $cascade[$step + 1]['key'], $value['id'], $step + 1) . '</li>';
                            //}
                        } else {
                            $res .= '<li><i class="mr-5 icon-file-text2"></i> ' . $value['name'] . '</a>';
                        }
                    }
                    $res .= '</ul>';
                }
                return $res;
           }
        }
    }
?>
