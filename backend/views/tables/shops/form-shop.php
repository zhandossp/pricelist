<?php
    use backend\models\Dealers;
?>
<!-- ENGINE -->
<script type="text/javascript" src="/profile/files/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="/profile/files/js/pages/form_layouts.js"></script>

<!---LOCAL --->
<script type="text/javascript" src="/profile/files/js/mytables/shops/form.js"></script>
<!------------>

<?=$this->render("/layouts/header/_header", array("model" => $model))?>

<div class="content">
    <form id = "form">
        <div class="panel panel-flat">
            <div class="panel-body">
                <?
                    $array_filtr = Yii::$app->session->get('filtr');
                ?>
                <? if ((Yii::$app->session->get('profile_role') == 'admin' OR Yii::$app->session->get('profile_role') == 'dealer' OR Yii::$app->session->get('profile_role') == 'superadmin') AND $array_filtr['shops']['user_id'] == null) { ?>
                    <div class = "col-md-12">
                        <? $sellers_list = Dealers::find()->where(['role' => 'seller'])->all(); ?>
                        <div class="form-group">
                            <label class = "text-semibold">Кому из продавцов принадлежит магазин:</label>
                            <select name = "rod_id" class="select" required ="required">
                                <option value="">Не выбран</option>
                                <? foreach ($sellers_list as $key => $value) { ?>
                                    <option <? if ($value->id == $model->user_id) { ?>selected<? } ?> value="<?=$value->id?>"><?=$value->fio?> (<?=$value->company?>)</option>
                                <? } ?>
                            </select>
                        </div>
                    </div>
                <? } ?>
                <div class="col-md-6">
                    <input name="id" type="hidden" class="form-control" value = "<?=$model->shop_id?>">
                    <input name="_csrf-backend" type="hidden" class="form-control" value = "<?=Yii::$app->getRequest()->getCsrfToken()?>">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Город", "city_id", "text", $model->city_id, "true")))?>
                </div>
                <div class="col-md-6">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Название", "shop_name", "text", $model->shop_name, "true")))?>
                </div>
                <div class = "col-md-12">
                    <?=$this->render('/layouts/modal-components/_textarea', array('info' => array("Описание", "shop_description", $model->shop_description, "true")))?>
                </div>

                <div class = "col-md-6">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Режим работы", "mode", "text", $model->mode, "true")))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Прием заказов по времени", "mode_order", "text", $model->mode_order, "true")))?>

                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Стоимость доставки", "shop_delivery_price", "text", $model->shop_delivery_price, "true")))?>

                </div>
                <div class = "col-md-6">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Минимальная сумма заказа", "shop_min_price", "text", $model->shop_min_price, "true")))?>

                    <div class="form-group">
                        <label class = "text-semibold">Номер телефона:</label>
                        <input type="text" name = "Information[shop_contacts]" data-mask="+7(999)-999-99-99" class="form-control" value = "<?=$model->shop_contacts?>" required = "required" placeholder="Номер телефона">
                    </div>
                    <?=$this->render('/layouts/modal-components/_select', array('info' => array("Статус", "status", array("1" => "Активный", "0" => "Неактивный"), $model->status)))?>
                </div>
                <div class = "col-md-12">
                    <? $load_access = explode(":", Yii::$app->session->get('profile_access')); ?>
                    <? if (in_array("monetization", $load_access) OR Yii::$app->session->get('profile_role') == "superadmin") { ?>
                        <?=$this->render('/layouts/modal-components/_input', array('info' => array("Процент монетизации", "monetization", "text", $model->monetization, "true")))?>
                    <? } ?>
                </div>
                <div class = "col-md-12">
                    <div class="form-group">
                        <label class="display-block text-semibold">Изображение:</label>
                        <? if ($model->shop_img != null) { ?>
                            <div class="form-group">
                                <img src = "uploads/shops/<?=$model->shop_img?>" />
                            </div>
                        <? } ?>
                        <input type="file" name = "Shops[image]" accept="image/*" class="file-styled">
                        <span class="help-block">Разрешенные форматы: gif, png, jpg.</span>
                    </div>
                    <div class="text-right">
                        <a href = "<?=Yii::$app->request->cookies['back']?>" class="cs-link btn btn-default">Отмена <i class="icon-x position-right"></i></a>
                        <? if ($model->shop_id != null) { ?>
                            <a href = "#delete" data-id = "<?=$model->shop_id?>" data-table = "shops" data-redirect = "shops" class="delete btn btn-danger">Удалить <i class="icon-trash-alt position-right"></i></a>
                        <? } ?>
                        <button type="submit" class="btn btn-primary">Сохранить <i class="icon-check position-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
