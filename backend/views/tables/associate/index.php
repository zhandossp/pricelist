<script type="text/javascript" src="/profile/files/js/mytables/associate/index.js"></script>

<?=$this->render("/layouts/header/_header")?>

<div class="content">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="panel">
                <div class="panel-body">
                    <?=$this->render('/layouts/header/_filter', array('page' => $page))?>
                    <table class="table table-associate">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ф.И.О сотрудника</th>
                            <th>Отдел</th>
                            <th>Должность</th>
                            <th>E-Mail</th>
                            <th>Телефон</th>
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

