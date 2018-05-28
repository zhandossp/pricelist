<script type="text/javascript" src="/profile/files/js/mytables/filters/index.js"></script>
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
                            <th>Фильтр</th>
                            <th>Изменения</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

