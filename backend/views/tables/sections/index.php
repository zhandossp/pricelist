<script type="text/javascript" src="/profile/files/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="/profile/files/js/mytables/sections/script.js"></script>

<? use backend\models\Sections; ?>

<?=$this->render("/layouts/header/_header"); ?>

<div class="content">
    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group text-right">
                    <span class="input-group-btn text-center">
                        <a href = "sections/form-section" title = "Добавить" id="add-section" class="action-link btn btn-success add-ctg-btn legitRipple" data-type="sections" type="button"><i class="icon-plus2"></i></a>
                        <button title = "Изменить" id="edit-section" class="btn btn-primary add-ctg-btn legitRipple" data-type="sections" type="button"><i class="icon-pencil"></i></button>
                        <button title = "Удалить" id="remove-section" class="btn btn-danger remove-ctg-btn legitRipple" data-type="sections" type="button"><i class="icon-trash-alt"></i></button>
                    </span>
                </div>
            </div>
            <div class="panel panel-flat">
                <div class="table-responsive">
                    <table id="table-sections" class="table table-striped">
                        <thead>
                        <tr>
                            <th><span class="text-bold">Фильтры</span></th>
                        </tr>
                        </thead>
                        <tbody id = "rod">
                        <? $categories = Sections::find()->orderBy(['weight' => 'ASC'])->all(); ?>
                        <? foreach ($categories as $key => $value) { ?>
                            <tr data-id="<?=$value->id?>" data-type = "sections" class = "select-section">
                                <td>
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
                    <span class="input-group-btn text-center">
                        <button title = "Добавить" id="action-section" data-check = "add" class="btn btn-success add-ctg-btn legitRipple" data-type="categories" type="button"><i class="icon-plus2"></i></button>
                        <button title = "Изменить" id="action-section" data-check = "edit" class="btn btn-primary add-ctg-btn legitRipple" data-type="categories" type="button"><i class="icon-pencil"></i></button>
                        <button title = "Удалить" id="remove-section" class="btn btn-danger remove-ctg-btn legitRipple" data-type="categories" type="button"><i class="icon-trash-alt"></i></button>
                    </span>
                </div>
            </div>
            <div class="panel panel-flat">
                <div class="table-responsive">
                    <table id="table-categories" class="table table-striped">
                        <thead>
                        <tr>
                            <th><span class="text-bold">Значения</span></th>
                        </tr>
                        </thead>
                        <tbody id = "categories"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">

            <div class="form-group">
                <div class="input-group text-right">
                    <span class="input-group-btn text-center">
                        <button title = "Добавить" id="action-section" data-check = "add" class="btn btn-success add-ctg-btn legitRipple" data-type="subcategories" type="button"><i class="icon-plus2"></i></button>
                        <button title = "Изменить" id="action-section" data-check = "edit" class="btn btn-primary add-ctg-btn legitRipple" data-type="subcategories" type="button"><i class="icon-pencil"></i></button>
                        <button title = "Удалить" id="remove-section" class="btn btn-danger remove-ctg-btn legitRipple" data-type="subcategories" type="button"><i class="icon-trash-alt"></i></button>
                    </span>
                </div>
            </div>

            <div class="panel panel-flat">
                <div class="table-responsive">
                    <table id="table-subcategories" class="table table-striped">
                        <thead>
                        <tr>
                            <th><span class="text-bold">Скидка</span></th>
                        </tr>
                        </thead>
                        <tbody id = "subcategories"></tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>
</div>

<script>
    $('body').off('click', '.section-weight');
    $('body').on('click', '.section-weight', function () {
        var token = $('meta[name=csrf-token]').attr("content");
        var id = $(this).data("id");
        var type = $(this).data("type");
        var current = $(this);
        var tr = current.parent().parent();
        $.ajax({
            type: "POST",
            url: "/profile/sections/weight/",
            data: {"_csrf-backend":token, type:type, id:id},
            success: function (data) {
                if (data == 1) {
                    if (type == "up") {
                        tr.insertAfter(tr.next());
                    } else {
                        tr.insertBefore(tr.prev());
                    }
                }
            },
        }).fail(function (xhr) {
            console.log("error");
        });
    });
</script>

