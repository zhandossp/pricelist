<script type="text/javascript" src="/profile/files/js/mytables/orders/index.js"></script>

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
                            <th>Покупатель</th>
                            <th>Адрес</th>
                            <th>Сумма</th>
                            <th>Комментарий</th>
                            <th>Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

