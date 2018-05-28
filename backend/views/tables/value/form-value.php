<?php
use backend\models\News;
use backend\models\Filters;
?><!-- ENGINE -->
<script type="text/javascript" src="/profile/files/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="/profile/files/js/pages/form_layouts.js"></script>

<!---LOCAL --->
<script type="text/javascript" src="/profile/files/js/mytables/value/form.js"></script>
<!------------>

<?=$this->render("/layouts/header/_header", array("model" => $model))?>

<div class="content">
    <form id = "form">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="form-group">
                    <input name="id" type="hidden" class="form-control" value = "<?=$model->id?>">
                    <input name="_csrf-backend" type="hidden" class="form-control" value = "<?=Yii::$app->getRequest()->getCsrfToken()?>">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Значение", "value", "text", $model->value, "true")))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Скидка", "sale", "text", $model->sale, "true")))?>
                </div>
                <div class="col-md-6">
                    <input name="id" type="hidden" class="form-control" value = "<?=$model->id?>">
                    <input name="_csrf-backend" type="hidden" class="form-control" value = "<?=Yii::$app->getRequest()->getCsrfToken()?>">
                    <? $filters_list = Filters::find()->all(); ?>
                    <div>
                        <label class = "text-semibold">Фильтр:</label>
                        <select name = "Information[filter_id]" class="select" required ="required">
                            <option value="">Не выбран</option>
                            <? foreach ($filters_list as $key => $value) { ?>
                                <option <? if ($value->id == $model->filter_id) { ?>selected<? } ?> value="<?=$value->id?>"><?=$value->title?></option>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <div class="text-right">
                    <a href = "<?=Yii::$app->request->cookies['back']?>" class="cs-link btn btn-default">Отмена <i class="icon-x position-right"></i></a>
                    <? if ($model->id != null) { ?>
                        <a href = "#delete" data-id = "<?=$model->id?>" data-table = "value" data-redirect = "value" class="delete btn btn-danger">Удалить <i class="icon-trash-alt position-right"></i></a>
                    <? } ?>
                    <button type="submit" class="btn btn-primary">Сохранить <i class="icon-check position-right"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>
