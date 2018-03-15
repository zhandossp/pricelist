<!-- ENGINE -->
<script type="text/javascript" src="/profile/files/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="/profile/files/js/pages/form_layouts.js"></script>

<!---LOCAL --->
<script type="text/javascript" src="/profile/files/js/mytables/dealers/form.js"></script>
<!------------>

<?=$this->render("/layouts/header/_header", array("model" => $model))?>

<div class="content">
    <form id = "form">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="col-md-6">
                    <input name="id" type="hidden" class="form-control" value = "<?=$model->id?>">
                    <input name="_csrf-backend" type="hidden" class="form-control" value = "<?=Yii::$app->getRequest()->getCsrfToken()?>">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Дилер города", "name", "text", $model->name, "true")))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Ф.И.О представителя", "fio", "text", $model->fio, "true")))?>

                    <div class="form-group">
                        <label class = "text-semibold">Номер телефона:</label>
                        <input type="text" name = "Information[phone]" data-mask="+7(999)-999-99-99" class="form-control" value = "<?=$model->phone?>" required = "required" placeholder="Номер телефона">
                    </div>
                    <div class="form-group">
                        <label class = "text-semibold">Физический адрес:</label>
                        <input type="text" name = "Information[f_address]" class="form-control" value = "<?=$model->f_address?>" placeholder="Физический адрес">
                    </div>
                    <div class="form-group">
                        <label class = "text-semibold">Банк:</label>
                        <input type="text" name = "Information[bank]" class="form-control" value = "<?=$model->bank?>" placeholder="Банк">
                    </div>
                    <div class="form-group">
                        <label class = "text-semibold">БИК:</label>
                        <input type="text" name = "Information[bik]" class="form-control" value = "<?=$model->bik?>" placeholder="БИК">
                    </div>
                </div>
                <div class="col-md-6">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Компания", "company", "text", $model->company, "true")))?>
                    <div class="form-group">
                        <label class = "text-semibold">E-Mail адрес:</label>
                        <input type="email" name = "Information[email]" class="form-control" value = "<?=$model->email?>" required = "required" placeholder="E-Mail адрес">
                    </div>
                    <div class="form-group">
                        <label class = "text-semibold">Юридический адрес:</label>
                        <input type="text" name = "Information[u_address]" class="form-control" value = "<?=$model->u_address?>" placeholder="Юридический адрес">
                    </div>
                    <div class="form-group">
                        <label class = "text-semibold">БИН:</label>
                        <input type="text" name = "Information[bin]" class="form-control" value = "<?=$model->bin?>" placeholder="Бин">
                    </div>
                    <div class="form-group">
                        <label class = "text-semibold">ИИК:</label>
                        <input type="text" name = "Information[iik]" class="form-control" value = "<?=$model->iik?>" placeholder="ИИК">
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
                    <?=$this->render('/layouts/modal-components/_select', array('info' => array("Статус", "status", array("1" => "Активный", "0" => "Неактивный"), $model->status)))?>
                </div>

                <?=$this->render("/layouts/priceclick-components/_access", array("name" => "dealers", "access" => $model->access))?>

                <div class = "col-md-12">
                    <div class="text-right">
                        <a href = "<?=Yii::$app->request->cookies['back']?>" class="cs-link btn btn-default">Отмена <i class="icon-x position-right"></i></a>
                        <? if ($model->id != null) { ?>
                            <a href = "#delete" data-id = "<?=$model->id?>" data-table = "dealers" data-redirect = "dealers" class="delete btn btn-danger">Удалить <i class="icon-trash-alt position-right"></i></a>
                        <? } ?>
                        <button type="submit" class="btn btn-primary">Сохранить <i class="icon-check position-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
