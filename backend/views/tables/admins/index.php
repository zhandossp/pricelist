<script type="text/javascript" src="/profile/files/js/mytables/admins/index.js"></script>

<?=$this->render("/layouts/header/_header")?>

<div class="content">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="panel">
                <div class="panel-body">
                    <?=$this->render('/layouts/header/_filter', array('page' => $page))?>
                    <div id = "dynamic-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ф.И.О</th>
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
</div>

