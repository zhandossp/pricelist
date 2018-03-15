<script type="text/javascript" src="/profile/files/js/plugins/visualization/echarts/echarts.js"></script>
<script type="text/javascript" src="/profile/files/js/charts/echarts/pies_donuts.js"></script>

<?
use backend\models\Cities;
use backend\models\Countries;
use backend\models\Dealers;
?>

<?=$this->render("/layouts/header/_header")?>

<? $model = Dealers::find()->where(['role' => 'dealer'])->all(); ?>

<div class="content">
    <div class="panel panel-flat">

        <div class="table-responsive">
            <table class="table table-lg text-nowrap">
                <tbody>
                <tr>
                    <td class="col-md-5">
                        <div class="media-left">
                            <h5 class="text-semibold no-margin">Всего дилеров: <?=count($model)?></h5>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="table-responsive">
            <table class="table text-nowrap">
                <tbody>
                <? $countries = Countries::find()->all(); ?>
                <? foreach ($countries as $country) { ?>
                    <tr class="active border-double">
                        <td colspan="5" class = "text-semibold"><?=$country->name?></td>
                    </tr>
                    <? $cities = Cities::find()->where(['country_id' => $country->id])->all(); ?>
                    <? foreach ($cities as $city) { ?>
                        <tr>
                            <td>
                                <div class="media-left">
                                    <div class=""><a href="#" class = "text-semibold"><?=$city->name?></a></div>
                                    <div class="text-muted text-size-small">
                                        Дилеров: <?=Dealers::find()->where(['role' => 'dealer', 'city' => $city->id])->count(); ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <? } ?>
                <? } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class = "col-md-6">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="chart-container has-scroll">
                        <div class="chart has-fixed-height has-minimum-width" id="piedealers"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class = "col-md-6">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="chart-container has-scroll">
                        <div class="chart has-fixed-height has-minimum-width" id="piecities"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

