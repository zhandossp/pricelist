<script type="text/javascript" src="/profile/files/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="/profile/files/js/mytables/magaz/index.js"></script>
<? use backend\models\Magaz;
use backend\models\Tovar;
use backend\controllers\MagazController;
?>

<?=$this->render("/layouts/header/_header"); ?>

<div class="content">
    <div class="row">
        <div class="col-md-4">
            <? $categories = Magaz::find()->all(); ?>
            <? foreach ($categories as $key => $value) { ?>
            <div class="panel panel-flat">
                <div class="table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><span class="text-bold"><?=$value->title?></span></th>
                            </tr>
                        </thead>
                        <tbody id = "id">
                        <? $tovary = Tovar::find()->where(['parrent_id' => $value->id])->all(); ?>
                        <? foreach ($tovary as $key => $qwe) {?>
                            <table class="table">
                                <tbody id = "id">
                                    <tr data-type = "sections" class = "section">
                                        <td>
                                            <a><?=$qwe->title?></a>
                                            <a class = "click" data-id="<?=$qwe->id?>"><i class="icon-info3"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <? }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <? } ?>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('body').off('click', '.click');
        $('body').on('click', '.click', function () {
            var token = $('meta[name=csrf-token]').attr("content");
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: "/profile/magaz/load",
                data: {id:id},
                success: function (data) {
                    alert(data);
                },
            }).fail(function (xhr) {
                console.log(xhr.responseText);
            });
        });
    });
</script>