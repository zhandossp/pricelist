<script type="text/javascript" src="/profile/files/js/mytables/pricelist/index.js"></script>

<?=$this->render("/layouts/header/_header")?>

<div class="content">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="panel">
                <div class="panel-body">
                    <?=$this->render('/layouts/header/_filter', array('page' => $page))?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Артикул</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Наличие</th>
                            <th>Единица изменения</th>
                            <th>Цена</th>
                            <th>Изменения</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

