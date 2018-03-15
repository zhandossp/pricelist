<!-- ENGINE -->
<script type="text/javascript" src="/profile/files/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="/profile/files/js/pages/form_layouts.js"></script>

<!---LOCAL --->
<script type="text/javascript" src="/profile/files/js/mytables/admins/form.js"></script>
<!------------>

<?=$this->render("/layouts/header/_header", array("model" => $model))?>

<div class="content">
    <form id = "form">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="col-md-6">
                    <input name="id" type="hidden" class="form-control" value = "<?=$model->id?>">
                    <input name="_csrf-backend" type="hidden" class="form-control" value = "<?=Yii::$app->getRequest()->getCsrfToken()?>">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Ф.И.О", "fio", "text", $model->fio, "true")))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Физический адрес", "f_address", "text", $model->f_address, "true")))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("E-Mail адрес", "email", "email", $model->email, "true")))?>
                </div>
                <div class="col-md-6">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Должность", "position", "text", $model->position, "true")))?>
                    <div class="form-group">
                        <label class = "text-semibold">Номер телефона:</label>
                        <input type="text" name = "Information[phone]" data-mask="+7(999)-999-99-99" class="form-control" value = "<?=$model->phone?>" required = "required" placeholder="Номер телефона">
                    </div>
                    <div class="form-group">
                        <? if ($model->id != null) { ?>
                            <label class = "text-semibold">Изменить пароль:</label>
                        <? } else { ?>
                            <label class = "text-semibold">Пароль: <span class = "text-muted">(если оставить поле пустым, пароль будет сгенерирован)</label>
                        <? } ?>
                        <input type="text" name = "password" class="form-control" placeholder="Пароль">
                    </div>
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
                <?=$this->render("/layouts/priceclick-components/_access", array("name" => "admins", "access" => $model->access))?>


                <div class = "col-md-12">
                    <div class="text-right">
                        <a href = "<?=Yii::$app->request->cookies['back']?>" class="cs-link btn btn-default">Отмена <i class="icon-x position-right"></i></a>
                        <? if ($model->id != null) { ?>
                            <a href = "#delete" data-id = "<?=$model->id?>" data-table = "dealers" data-redirect = "admins" class="delete btn btn-danger">Удалить <i class="icon-trash-alt position-right"></i></a>
                        <? } ?>
                        <button type="submit" class="btn btn-primary">Сохранить <i class="icon-check position-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
