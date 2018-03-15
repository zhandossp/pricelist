<!-- ENGINE -->
<script type="text/javascript" src="/profile/files/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="/profile/files/js/pages/form_layouts.js"></script>

<!---LOCAL --->
<script type="text/javascript" src="/profile/files/js/mytables/cities/form.js"></script>
<!------------>

<?=$this->render("/layouts/header/_header", array("model" => $model))?>

<div class="content">
    <form id = "form">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="col-md-6">
                    <input name="id" type="hidden" class="form-control" value = "<?=$model->id?>">
                    <input name="_csrf-backend" type="hidden" class="form-control" value = "<?=Yii::$app->getRequest()->getCsrfToken()?>">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Город", "name", "text", $model->name, "true")))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("E-Mail вопросы и предложения", "faq_email", "email", $model->faq_email, "true")))?>
                    <div class="form-group">
                        <label class = "text-semibold">Телефон по работе с подключением</label>
                        <input type="text" name = "Information[connect_phone]" data-mask="+7(999)-999-99-99" class="form-control" value = "<?=$model->connect_phone?>" required = "required" placeholder="Телефон по работе с подключением">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class = "text-semibold">Страна:</label>
                        <select name = "Information[country_id]" class="select" required ="required">
                            <? $countries = \backend\models\Countries::find()->all(); ?>
                            <? foreach ($countries as $key => $value) { ?>
                                <option <? if ($value->id == $model->country_id) { ?>selected<? } ?> value="<?=$value->id?>"><?=$value->name?></option>
                            <? } ?>
                        </select>
                    </div>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("E-Mail по работе с подключением", "connect_email", "email", $model->connect_email, "true")))?>
                    <div class="form-group">
                        <label class = "text-semibold">WhatsApp по работе с подключением</label>
                        <input type="text" name = "Information[connect_whatsapp]" data-mask="+7(999)-999-99-99" class="form-control" value = "<?=$model->connect_whatsapp?>" required = "required" placeholder="WhatsApp по работе с подключением">
                    </div>                </div>
                <div class = "col-md-12">
                    <?=$this->render('/layouts/modal-components/_select', array('info' => array("Статус", "status", array("1" => "Активный", "0" => "Неактивный"), $model->status)))?>
                    <div class="text-right">
                        <a href = "<?=Yii::$app->request->cookies['back']?>" class="cs-link btn btn-default">Отмена <i class="icon-x position-right"></i></a>
                        <? if ($model->id != null) { ?>
                            <a href = "#delete" data-id = "<?=$model->id?>" data-table = "cities" data-redirect = "cities" class="delete btn btn-danger">Удалить <i class="icon-trash-alt position-right"></i></a>
                        <? } ?>
                        <button type="submit" class="btn btn-primary">Сохранить <i class="icon-check position-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
