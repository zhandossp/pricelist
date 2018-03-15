<script type="text/javascript" src="/profile/files/js/mytables/sellers/index.js"></script>
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
                            <th>Ф.И.О представителя</th>
                            <th>Тип продавца</th>
                            <th>Компания</th>
                            <th>Город</th>
                            <th>E-Mail</th>
                            <th>Телефон</th>
                            <th>Статус</th>
                            <th>Изменения</th>
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

