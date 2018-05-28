<script type="text/javascript" src="/profile/files/js/mytables/value/index.js"></script>
<?=$this->render("/layouts/header/_header")?>

<div class="content">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="panel">
                <div class="panel-body">
                    <?=$this->render('/layouts/header/_filter', array('page' => $page))?>
                    <table class="table table-sellers">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Значение</th>
                                <th>Название фильтра</th>
                                <th>Скидка</th>
                                <th>Изменения</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

