<!-- ENGINE -->
<script type="text/javascript" src="/profile/files/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="/profile/files/js/pages/form_layouts.js"></script>

<!---LOCAL --->
<script type="text/javascript" src="/profile/files/js/mytables/feedback/form.js"></script>
<!------------>

<?=$this->render("/layouts/header/_header", array("model" => $model))?>

<div class="content">
    <form id = "form">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="col-md-6">
                    <input name="id" type="hidden" class="form-control" value = "<?=$model->id?>">
                    <input name="_csrf-backend" type="hidden" class="form-control" value = "<?=Yii::$app->getRequest()->getCsrfToken()?>">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Ф.И.О сотрудника", "name", "text", $model->name, "true")))?>
                                       <div class="form-group">
                        <label class = "text-semibold">Номер телефона:</label>
                        <input type="text" name = "Information[phone]" data-mask="+7(999)-999-99-99" class="form-control" value = "<?=$model->phone?>" required = "required" placeholder="Номер телефона">
                    </div>
                </div>
                <div class = "col-md-12">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary"> Заявка на обраную связь <i class="icon-check position-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
