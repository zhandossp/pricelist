<?php
use backend\models\News;
use backend\models\Category;
?>
<!-- ENGINE -->
<script type="text/javascript" src="/profile/files/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="/profile/files/js/pages/form_layouts.js"></script>

<!---LOCAL --->
<script type="text/javascript" src="/profile/files/js/mytables/pricelist/form.js"></script>
<!------->

<?=$this->render("/layouts/header/_header", array("model" => $model))?>

<div class="content">
    <form id = "form">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="col-md-6">
                    <input name="id" type="hidden" class="form-control" value = "<?=$model->id?>">
                    <input name="_csrf-backend" type="hidden" class="form-control" value = "<?=Yii::$app->getRequest()->getCsrfToken()?>">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Артикул", "article", "text", $model->article, "true")))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Название", "title", "text", $model->title, "true")))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Наличие", "availability","text", $model->availability, "true")))?>
                    <div class = "form-group">
                    <?=$this->render('/layouts/modal-components/_textarea', array('info' => array("Описание", "description",  $model->description, "true")))?>
                    </div>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Едниница измерения", "unit","text",  $model->unit, "true")))?>
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Цена", "price","text",  $model->price, "true")))?>
                    </div>
                <div class = "col-md-6">
                    <div class="form-group">
                        <label class="display-block text-semibold">Изображение:</label>
                        <? if ($model->image != null) { ?>
                            <div class="form-group">
                                <img src = "uploads/pricelist/<?=$model->image?>" />
                            </div>
                        <? } ?>
                        <input type="file" name = "Pricelist[image]" accept="image/*" class="file-styled">
                        <span class="help-block">Разрешенные форматы: gif, png, jpg.</span>
                    </div>
                    <div class="text-right">
                        <a href = "<?=Yii::$app->request->cookies['back']?>" class="cs-link btn btn-default">Отмена <i class="icon-x position-right"></i></a>
                        <? if ($model->id != null) { ?>
                            <a href = "#delete" data-id = "<?=$model->id?>" data-table = "pricelist" data-redirect = "pricelist" class="delete btn btn-danger">Удалить <i class="icon-trash-alt position-right"></i></a>
                        <? } ?>
                        <button type="submit" class="btn btn-primary">Сохранить <i class="icon-check position-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
