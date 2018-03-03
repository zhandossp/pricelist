<script type="text/javascript" src="/profile/files/js/mytables/sections/script.js"></script>

<?=$this->render("/layouts/header/_header")?>

<div class="content">
    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group text-right">
                    <span class="input-group-btn text-center">
                        <button title = "Добавить" id="add-section" class="btn btn-success add-ctg-btn legitRipple" data-name="sections" type="button"><i class="icon-plus2"></i></button>
                        <button title = "Изменить" id="edit-section" class="btn btn-primary add-ctg-btn legitRipple" data-name="sections" type="button"><i class="icon-pencil"></i></button>
                        <button title = "Удалить" id="remove-section" class="btn btn-danger remove-ctg-btn legitRipple" data-name="sections" type="button"><i class="icon-trash-alt"></i></button>
                    </span>
                </div>
            </div>
            <div class="panel panel-flat">
                <div class="table-responsive">
                    <table id="table-sections" class="table table-striped">
                        <thead>
                        <tr>
                            <th><span class="text-bold">Категории</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <? $categories = \backend\models\Sections::find()->all(); ?>
                        <? foreach ($categories as $key => $value) { ?>
                            <tr data-type = "sections" class = "select-section">
                                <td data-id="<?=$value->id?>">
                                    <img width = "40" class = "mr-10" style = "border:1px solid grey;" src = "/profile/uploads/sections/<?=$value->section_image?>">
                                    <?=$value->name?>
                                </td>
                            </tr>
                        <? } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group text-right">
                <span class="input-group-btn">
                    <button id="remove-category-button" class="btn btn-danger remove-ctg-btn legitRipple" data-name="category" type="button">-</button>
                </span>
                    <span class="input-group-btn text-left">
                    <button id="add-category-button" class="btn btn-primary add-ctg-btn legitRipple" data-name="category" type="button">+</button>
                </span>
                </div>
            </div>
            <div class="panel panel-flat">
                <div class="table-responsive">
                    <table id="table-categories" class="table table-striped">
                        <thead>
                            <tr>
                                <th><span class="text-bold">Разделы</span></th>
                            </tr>
                        </thead>
                        <tbody id = "categories">
                            <tr data-type = "categ" class = "select-section">
                                <td data-section-id="13" data-category-id="7" class="active">Часы</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">

            <div class="form-group">
                <div class="input-group text-right">
                <span class="input-group-btn">
                    <button id="remove-subcategory-button" class="btn btn-danger remove-ctg-btn legitRipple" data-name="subcategory" type="button">-</button>
                </span>
                    <span class="input-group-btn text-left">
                    <button id="add-subcategory-button" class="btn btn-primary add-ctg-btn legitRipple" data-name="subcategory" type="button">+</button>
                </span>
                </div>
            </div>

            <div class="panel panel-flat">
                <div class="table-responsive">
                    <table id="table-subcategory" class="table table-striped">
                        <thead>
                            <tr>
                                <th><span class="text-bold">Подразделы</span></th>
                            </tr>
                        </thead>
                        <tbody id = "subcategories">
                            <tr>
                                <td data-subcategory-id="9" class="active">Водяные часы</td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>

        </div>

    </div>
</div>

