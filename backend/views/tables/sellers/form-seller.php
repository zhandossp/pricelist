<?
    use backend\models\Dealers;
?>
<!-- ENGINE -->
<script type="text/javascript" src="/profile/files/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="/profile/files/js/pages/form_layouts.js"></script>

<!---LOCAL --->
<script type="text/javascript" src="/profile/files/js/mytables/sellers/form.js"></script>
<!------------>

<?=$this->render("/layouts/header/_header", array("model" => $model))?>

<div class="content">
    <form id = "form">
        <div class="panel panel-flat">
            <div class="panel-body">
                <?
                    $array_filtr = Yii::$app->session->get('filtr');
                ?>
                <? if ((Yii::$app->session->get('profile_role') == 'admin' OR Yii::$app->session->get('profile_role') == 'superadmin') AND $array_filtr['sellers']['rod_id'] == null) { ?>
                    <div class = "col-md-12">
                        <? $dealers_list = Dealers::find()->where(['role' => 'dealer'])->all(); ?>
                        <div class="form-group">
                            <label class = "text-semibold">Кому из дилеров принадлежит продавец:</label>
                            <select name = "rod_id" class="select" required ="required">
                                <option value="">Не выбран</option>
                                <? foreach ($dealers_list as $key => $value) { ?>
                                    <option <? if ($value->id == $model->rod_id) { ?>selected<? } ?> value="<?=$value->id?>"><?=$value->name?></option>
                                <? } ?>
                            </select>
                        </div>
                    </div>
                <? } ?>
                <div class="col-md-6">
                    <input name="id" type="hidden" class="form-control" value = "<?=$model->id?>">
                    <input name="_csrf-backend" type="hidden" class="form-control" value = "<?=Yii::$app->getRequest()->getCsrfToken()?>">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Город", "city", "text", $model->city, "true")))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Компания", "company", "text", $model->company, "true")))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("E-Mail адрес", "email", "email", $model->email, "true")))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Юридический адрес", "u_address", "text", $model->u_address, false)))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("БИН", "bin", "text", $model->bin, false)))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("ИИК", "iik", "text", $model->iik, false)))?>
                    <?=$this->render('/layouts/modal-components/_select', array('info' => array("Статус", "status", array("1" => "Активный", "0" => "Неактивный"), $model->status)))?>
                </div>
                <div class="col-md-6">
                    <?=$this->render('/layouts/modal-components/_select', array('info' => array("Тип продавца", "seller_type", array("f" => "Физ. лицо", "u" => "Юр. лицо", "i" => "ИП"), $model->seller_type)))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Ф.И.О представителя", "fio", "text", $model->fio, "true")))?>
                    <div class="form-group">
                        <label class = "text-semibold">Номер телефона:</label>
                        <input type="text" name = "Information[phone]" data-mask="+7(999)-999-99-99" class="form-control" value = "<?=$model->phone?>" required = "required" placeholder="Номер телефона">
                    </div>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Физический адрес", "f_address", "text", $model->f_address, false)))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Банк", "bank", "text", $model->bank, false)))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("БИК", "bik", "text", $model->bik, false)))?>
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
                    <div class="text-right">
                        <a href = "<?=Yii::$app->request->cookies['back']?>" class="cs-link btn btn-default">Отмена <i class="icon-x position-right"></i></a>
                        <? if ($model->id != null) { ?>
                            <a href = "#delete" data-id = "<?=$model->id?>" data-table = "dealers" data-redirect = "sellers" class="delete btn btn-danger">Удалить <i class="icon-trash-alt position-right"></i></a>
                        <? } ?>
                        <button type="submit" class="btn btn-primary">Сохранить <i class="icon-check position-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
