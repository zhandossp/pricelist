<?php
use backend\models\Boxers;
?>
<!-- ENGINE -->
<script type="text/javascript" src="/profile/files/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="/profile/files/js/pages/form_layouts.js"></script>

<!---LOCAL --->
<script type="text/javascript" src="/profile/files/js/mytables/boxers/form.js"></script>
<!------->

<?=$this->render("/layouts/header/_header", array("model" => $model))?>

<div class="content">
    <form id = "form">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="col-md-6">
                    <input name="id" type="hidden" class="form-control" value = "<?=$model->id?>">
                    <input name="_csrf-backend" type="hidden" class="form-control" value = "<?=Yii::$app->getRequest()->getCsrfToken()?>">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Боксер", "name", "text", $model->name, "true")))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Титул", "title", "text", $model->title, "true")))?>
                </div>
                <div class = "col-md-12">
                    <div class="form-group">
                        <label class = "text-semibold">Статус:</label>
                        <select name = "Information[status]" class="select">
                            <option <? if ($model->status == 1) { ?>selected<? } ?> value="1">Активный</option>
                            <option <? if ($model->status == 0) { ?>selected<? } ?> value="0">Неактивный</option>
                        </select>
                    </div>
                </div>
                <div class = "col-md-12">
                        <div class="form-group">
                            <label class="display-block text-semibold">Изображение:</label>
                            <? if ($model->ava != null) { ?>
                                <div class="form-group">
                                    <img src = "uploads/boxers/<?=$model->ava?>" />
                                </div>  
                            <? } ?>
                            <input type="file" name = "Boxers[image]" accept="image/*" class="file-styled">
                            <span class="help-block">Разрешенные форматы: gif, png, jpg.</span>
                        </div>
                    <div class="text-right">
                        <a href = "<?=Yii::$app->request->cookies['back']?>" class="cs-link btn btn-default">Отмена <i class="icon-x position-right"></i></a>
                        <? if ($model->id != null) { ?>
                            <a href = "#delete" data-id = "<?=$model->id?>" data-table = "boxers" data-redirect = "boxers" class="delete btn btn-danger">Удалить <i class="icon-trash-alt position-right"></i></a>
                        <? } ?>
                        <button type="submit" class="btn btn-primary">Сохранить <i class="icon-check position-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
