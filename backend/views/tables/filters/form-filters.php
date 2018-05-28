<!-- ENGINE -->
<script type="text/javascript" src="/profile/files/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="/profile/files/js/pages/form_layouts.js"></script>

<!---LOCAL --->
<script type="text/javascript" src="/profile/files/js/mytables/filters/form.js"></script>
<!------------>

<?=$this->render("/layouts/header/_header", array("model" => $model))?>

<div class="content">
    <form id = "form">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="col-md-6">
                    <input name="id" type="hidden" class="form-control" value = "<?=$model->id?>">
                    <input name="_csrf-backend" type="hidden" class="form-control" value = "<?=Yii::$app->getRequest()->getCsrfToken()?>">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Фильр", "title", "text", $model->title, "true")))?>
                </div>
                <div class="text-right">
                    <a href = "<?=Yii::$app->request->cookies['back']?>" class="cs-link btn btn-default">Отмена <i class="icon-x position-right"></i></a>
                    <? if ($model->id != null) { ?>
                        <a href = "#delete" data-id = "<?=$model->id?>" data-table = "filters" data-redirect = "filters" class="delete btn btn-danger">Удалить <i class="icon-trash-alt position-right"></i></a>
                    <? } ?>
                    <button type="submit" class="btn btn-primary">Сохранить <i class="icon-check position-right"></i></button>
                </div>
        </div>
    </form>
</div>

