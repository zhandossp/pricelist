<script type="text/javascript" src="/profile/files/js/plugins/notifications/sweet_alert.min.js"></script>

<script type="text/javascript" src="/profile/files/js/mytables/feedback_list/index.js"></script>

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
                            <th>Ф.И.О</th>
                            <th>Номер</th>
                            <th>Создан</th>
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

