<?php

use backend\models\Params;
use backend\models\Shops;
use backend\models\Sections;
use backend\models\Categories;
use backend\models\Subcategories;
use backend\models\ProductsList;
use yii\widgets\ActiveForm;
?>

<!-- ENGINE -->
<script type="text/javascript" src="/profile/files/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="/profile/files/js/pages/form_layouts.js"></script>

<!---LOCAL --->
<script type="text/javascript" src="/profile/files/js/cronos/params_product.js"></script>
<script type="text/javascript" src="/profile/files/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
<script type="text/javascript" src ="/profile/files/js/plugins/forms/selects/bootstrap_select.min.js"></script>
<script type="text/javascript" src ="/profile/files/js/plugins/pickers/color/spectrum.js"></script>
<script type="text/javascript" src="/profile/files/js/mytables/products/form.js"></script>
<!------------>


<?=$this->render("/layouts/header/_header", array("model" => $model))?>

<div class="content">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'form', 'method' => 'POST']]) ?>
        <div class="panel panel-flat">
            <div class="panel-body">
                <?php
                    $product_list = ProductsList::find()->where(['product_id' => $model->id])->one();
                    if ($model->id == null) {
                        $select_disabled = 'disabled';
                    }
                ?>

                <?
                    $array_filtr = Yii::$app->session->get('filtr');
                ?>
                <? if ($array_filtr['products']['shop_id'] == null) { ?>
                    <div class = "col-md-12">
                        <? $shops_list = Shops::find()->all(); ?>
                        <div class="form-group">
                            <label class = "text-semibold">Какому магазину принадлежит товар:</label>
                            <select name = "shop_id" class="select" required ="required">
                                <option value="">Не выбран</option>
                                <? foreach ($shops_list as $key => $value) { ?>
                                    <option <? if ($value->shop_id == $model->shop_id) { ?>selected<? } ?> value="<?=$value->shop_id?>"><?=$value->shop_name?></option>
                                <? } ?>
                            </select>
                        </div>
                    </div>
                <? } ?>
                <div class="col-md-4">
                    <? $list = Sections::find()->all(); ?>
                    <div class="form-group">
                        <label class = "text-semibold">Категория:</label>
                        <select id = "section" name = "section" class="select" required ="required">
                            <option value="">Не выбрано</option>
                            <? foreach ($list as $key => $value) { ?>
                                <option <? if ($product_list->section_id == $value->id) { ?>selected<? } ?> value="<?=$value->id?>"><?=$value->name?></option>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id = "category">
                        <label class = "text-semibold">Раздел:</label>
                        <div id = "select_category">
                            <select id = "category" name = "category" class="select"  <?=$select_disabled?>>
                                <option value="">Не выбрано</option>
                                <? if ($product_list->category_id != null) { ?>
                                    <? $categories = Categories::find()->where(['section_id' => $product_list->section_id])->all(); ?>
                                    <? foreach ($categories as $value) { ?>
                                        <option <? if ($product_list->category_id == $value->id) { ?>selected<? } ?> value="<?=$value->id?>"><?=$value->name?></option>
                                    <? } ?>
                                <? } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id = "subcategory">
                        <label class = "text-semibold">Подраздел:</label>
                        <div id = "select_subcategory">
                            <select id = "subcategory" name = "subcategory" class="select"  <?=$select_disabled?>>
                                <option value="">Не выбрано</option>
                                <? if ($product_list->subcategory_id != null) { ?>
                                    <? $subcategories = Subcategories::find()->where(['category_id' => $product_list->category_id])->all(); ?>
                                    <? foreach ($subcategories as $value) { ?>
                                        <option <? if ($product_list->subcategory_id == $value->id) { ?>selected<? } ?> value="<?=$value->id?>"><?=$value->name?></option>
                                    <? } ?>
                                <? } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <input name="id" type="hidden" class="form-control" value = "<?=$model->id?>">
                    <input name="_csrf-backend" type="hidden" class="form-control" value = "<?=Yii::$app->getRequest()->getCsrfToken()?>">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Название", "product_name", "text", $model->product_name, true)))?>
                </div>
                <div class="col-md-12">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Цена", "product_price", "text", $model->product_price, true)))?>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class = "text-semibold">Размеры (необязательно)<br/><span class = "text-muted">Перечислите размеры через запятую:</span></label>
                        <?
                            $sizes = json_decode($model->sizes, true);
                            $sizes_result = null;
                            foreach ($sizes as $value) {
                                if ($sizes_result == null) {
                                    $sizes_result = $value;
                                } else {
                                    $sizes_result .= ",".$value;
                                }
                            }
                        ?>
                        <input type="text" name = "sizes" class="form-control" value = "<?=$sizes_result?>" placeholder="Например: 39,40,41">
                    </div>
                </div>
                <div class='col-md-12'>
                    <div class='form-group'>
                        <label class = 'text-semibold'>Цвета (Необязательно):</label>
                        <div class='form-group'>
                            <? $colors = json_decode($model->colors, true); ?>
                            <? foreach ($colors as $key => $value) { ?>
                                <div style = "display:inline-block;" class = "rod-color mb-10 mr-10">
                                    <input type='text' id = "id_<?=$key+1000?>" name = "colors[]" class='form-control colorpicker-palette-only' value='<?=$value?>'>
                                    <a href = "#" data-id = "<?=$key+1000?>" data-color = "<?=$value?>" class = "delete_color text-bold ml-5 mr-5">X</a>
                                </div>
                            <? } ?>
                            <div id='color-insert-helper'></div>
                            <button id='add-color-button' class='btn btn-primary' type='button'>Добавить</button>
                        </div>
                    </div>
                </div>
                <div class = "col-md-12 mb-20">
                    <div class="form-group">
                        <label class = 'text-semibold'>Характеристики товара:</label>
                        <div id="parameter-insert-helper">
                            <? if ($model->params != null) { ?>
                                <? $params = json_decode($model->params, true); ?>
                                <? foreach ($params as $key => $value) { ?>
                                    <div class='col-md-12 mb-10' style = 'padding:0;'>
                                        <div class='form-group'>
                                            <div class='col-lg-2' style = 'padding:0;'>
                                                <label>Название параметра:</label>
                                                <select name = "parameter[name][]" class="select" required ="required">
                                                    <? $params = Params::find()->where(['status' => 1])->all(); ?>
                                                    <? foreach ($params as $k => $val) { ?>
                                                        <option <? if ($val->id == $value) { ?>selected<? } ?> value="<?=$val->id?>"><?=$val->name?></option>
                                                    <? } ?>
                                                </select>
                                            </div>
                                            <div class='col-lg-3'>
                                                <label>Значение параметра:</label>
                                                <input type='text' name='parameter[value][]' value = '<?=$value?>' class='form-control' placeholder='Значение параметра'>
                                            </div>
                                           <div class='col-lg-1 mt-15'>
                                               <button id='remove-parameter-button' class='btn btn-danger' type='button'>X</button>
                                           </div>
                                       </div>
                                    </div>
                                <? } ?>
                            <? } ?>
                        </div>
                        <button id="add-parameter-button" class="btn btn-primary" type="button">Добавить</button>
                    </div>
                </div>
                <div class = "col-md-12">
                    <?=$this->render('/layouts/modal-components/_textarea', array('info' => array("Описание", "product_description", $model->product_description, true)))?>
                </div>
                <div class="col-md-12">
                    <?=$this->render('/layouts/modal-components/_input', array('info' => array("Ссылка на YouTube видео", "youtube", "text", $model->youtube, true)))?>
                </div>
                <div class = "col-md-12">
                    <div class="form-group">
                        <label class="col-lg-2 control-label text-semibold" style = "padding-left:0;" >Изображения:</label>
                        <div class="col-lg-10">
                            <input type="file" class="file-input-ajax" name = "Products[images][]" multiple="multiple" accept="image/*">
                            <span class="help-block">У Вас есть возможность загружать сразу несколько файлов.</span>
                        </div>
                    </div>
                </div>
                <div class = "col-md-12">
                    <?=$this->render('/layouts/modal-components/_select', array('info' => array("Статус", "status", array("1" => "Активный", "0" => "Неактивный"), $model->status)))?>
                    <div class="text-right">
                        <a href = "<?=Yii::$app->request->cookies['back']?>" class="cs-link btn btn-default">Отмена <i class="icon-x position-right"></i></a>
                        <? if ($model->id != null) { ?>
                            <a href = "#delete" data-id = "<?=$model->id?>" data-table = "products" data-redirect = "products" class="delete btn btn-danger">Удалить <i class="icon-trash-alt position-right"></i></a>
                        <? } ?>
                        <button type="submit" class="btn btn-primary">Сохранить <i class="icon-check position-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    <?php ActiveForm::end() ?>
</div>
<?
    $initialPreview = array();
    foreach (json_decode($model->product_imgs, true) as $value) {
        $initialPreview[] = "/profile/uploads/products/full/".$value;
        if ($initialPreviewConfig == null) {
            $initialPreviewConfig = '{showDrag:false, key:"' . $value . '", id:"'.$model->id.'"}';
        } else {
            $initialPreviewConfig .= ', {showDrag:false, key:"' . $value . '", id:"'.$model->id.'"}';
        }
    }
    $initialPreviewConfig = '['.$initialPreviewConfig.']';
    if ($model->id != null) {
        $model_id = $model->id;
    } else {
        $model_id = 0;
    }
?>
<script>
    $(function () {
        var token = $('meta[name=csrf-token]').attr("content");
        var palette = [
            ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
            ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
            ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
            ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
            ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
            ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
            ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
            ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
        ];

        $(".colorpicker-palette-only").spectrum({
            showPalette: true,
            showPaletteOnly: true,
            palette: palette,
        });

        $("body").off("click", ".delete_color");
        $("body").on("click", ".delete_color", function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            $("#id_" + id).remove();
            $(this).parent().remove();
        });

        $('.bootstrap-select').selectpicker();
        $("body").off("change", "#section");
        $("body").on("change", "#section", function () {
            var id = $("option:selected", this).val();
            ChangeSection(id);
        });

        function ChangeSection(id) {
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "/profile/products/section/",
                data:{"_csrf-backend":token, id:id},
                status: startLoading($("#form")),
                success: function (data) {
                    if (data.type == "information") {
                        setTimeout(function () {
                            window.location.href = "/profile/authentication/";
                        }, 2000);
                    } else if (data.type == "success") {
                        $("#select_category").html(data.value);
                        $("[name='category']").select2();
                        $("#form").unblock();
                        ChangeCategory(data.next);
                    }
                },
            }).fail(function (xhr) {
                console.log(xhr.responseText);
            });
        }

        $("body").off("change", "#category");
        $("body").on("change", "#category", function () {
            var id = $("option:selected", this).val();
            ChangeCategory(id);
        });

        function ChangeCategory(id) {
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "/profile/products/category/",
                data:{"_csrf-backend":token, id:id},
                status: startLoading($("#form")),
                success: function (data) {
                    console.log(data);
                    if (data.type == "information") {
                        setTimeout(function () {
                            window.location.href = "/profile/authentication/";
                        }, 2000);
                    } else if (data.type == "success") {
                        $("#select_subcategory").html(data.value);
                        $("[name='subcategory']").select2();
                        $("#form").unblock();
                    }
                },
            }).fail(function (xhr) {
                console.log(xhr.responseText);
            });
        }

        function startLoading(block) {
            $(block).block({
                message: '<i class="icon-spinner4 spinner"></i>',
                overlayCSS: {
                    backgroundColor: 'rgba(63, 158, 195, 0.59)',
                    opacity: 1,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    color: '#fff',
                    backgroundColor: 'transparent'
                }
            });
        }

        // Modal template
        var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
            '  <div class="modal-content">\n' +
            '    <div class="modal-header">\n' +
            '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
            '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
            '    </div>\n' +
            '    <div class="modal-body">\n' +
            '      <div class="floating-buttons btn-group"></div>\n' +
            '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
            '    </div>\n' +
            '  </div>\n' +
            '</div>\n';

        // Buttons inside zoom modal
        var previewZoomButtonClasses = {
            toggleheader: 'btn btn-default btn-icon btn-xs btn-header-toggle',
            fullscreen: 'btn btn-default btn-icon btn-xs',
            borderless: 'btn btn-default btn-icon btn-xs',
            close: 'btn btn-default btn-icon btn-xs'
        };

        // Icons inside zoom modal classes
        var previewZoomButtonIcons = {
            prev: '<i class="icon-arrow-left32"></i>',
            next: '<i class="icon-arrow-right32"></i>',
            toggleheader: '<i class="icon-menu-open"></i>',
            fullscreen: '<i class="icon-screen-full"></i>',
            borderless: '<i class="icon-alignment-unalign"></i>',
            close: '<i class="icon-cross3"></i>'
        };

        // File actions
        var fileActionSettings = {
            zoomClass: 'btn btn-link btn-xs btn-icon',
            zoomIcon: '<i class="icon-zoomin3"></i>',
            dragClass: 'btn btn-link btn-xs btn-icon',
            dragIcon: '<i class="icon-three-bars"></i>',
            removeClass: 'btn btn-link btn-icon btn-xs',
            removeIcon: '<i class="icon-trash"></i>',
            indicatorNew: '<i class="icon-file-plus text-slate"></i>',
            indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
            indicatorError: '<i class="icon-cross2 text-danger"></i>',
            indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
        };

        var token = $('meta[name=csrf-token]').attr("content");
        $(".file-input-ajax").fileinput({
            browseLabel: 'Выбрать',
            dropZoneEnabled: true,
            uploadUrl: "/profile/products/upload/",
            deleteUrl: '/profile/products/deleteimgs/',
            uploadAsync: false,
            showUpload: false,
            showRemove: false,
            maxFileCount: 10,
            allowedFileExtensions: ["jpg", "gif", "png", "jpeg"],
            fileActionSettings: {
                removeIcon: '<i class="icon-bin"></i>',
                removeClass: 'btn btn-link btn-xs btn-icon',
                uploadIcon: '<i class="icon-upload"></i>',
                uploadClass: 'btn btn-link btn-xs btn-icon',
                zoomIcon: '<i class="icon-zoomin3"></i>',
                zoomClass: 'btn btn-link btn-xs btn-icon',
                indicatorNew: '<i class="icon-file-plus text-slate"></i>',
                indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
                indicatorError: '<i class="icon-cross2 text-danger"></i>',
                indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
            },
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialPreview: <?=json_encode($initialPreview)?>,
            initialPreviewConfig: <?=$initialPreviewConfig?>,
            initialPreviewShowDelete: true,
            initialPreviewAsData: true,
            overwriteInitial: false,
            initialPreviewFileType: 'image',
            initialCaption: "Изображения не выбраны",
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons,
            uploadExtraData: {
                "_csrf-backend": token
            },
            deleteExtraData: {
                "model_id":<?=$model_id?>,
                "_csrf-backend": token
            }
        }).on('filepredelete', function (event, data) {
            console.log(event);
            console.log(data);
        });
    });
</script>
