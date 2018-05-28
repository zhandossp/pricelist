<!-- ENGINE -->
<script type="text/javascript" src="/profile/files/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="/profile/files/js/pages/form_layouts.js"></script>

<!---LOCAL --->
<script type="text/javascript" src="/profile/files/js/mytables/category/form.js"></script>
<!------------>

<?=$this->render("/layouts/header/_header", array("model" => $model))?>

<div class="content">
    <form id = "form">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="col-md-6">
                    <input name="id" type="hidden" class="form-control" value = "<?=$model->id?>">
                    <input name="_csrf-backend" type="hidden" class="form-control" value = "<?=Yii::$app->getRequest()->getCsrfToken()?>">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Страна", "name", "text", $model->name, "true")))?>
                </div>
                <div class="col-md-6">
                    <?=$this->render('/layouts/modal-components/_select', array('info' => array("Статус", "status", array("1" => "Активный", "0" => "Неактивный"), $model->status)))?>
                </div>
                <div class = "col-md-12">
                    <div class="text-right">
                        <a href = "<?=Yii::$app->request->cookies['back']?>" class="cs-link btn btn-default">Отмена <i class="icon-x position-right"></i></a>
                        <? if ($model->id != null) { ?>
                            <a href = "#delete" data-id = "<?=$model->id?>" data-table = "category" data-redirect = "category" class="delete btn btn-danger">Удалить <i class="icon-trash-alt position-right"></i></a>
                        <? } ?>
                        <button type="submit" class="btn btn-primary">Сохранить <i class="icon-check position-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
