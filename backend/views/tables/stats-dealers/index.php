<script type="text/javascript" src="/profile/files/js/plugins/visualization/echarts/echarts.js"></script>
<script type="text/javascript" src="/profile/files/js/charts/echarts/pies_donuts.js"></script>

<?
use backend\models\Cities;
use backend\models\Countries;
use backend\models\Dealers;
?>

<?=$this->render("/layouts/header/_header")?>

<?
    $data_dealers_1 = array();
    $data_dealers_2 = array();
    $model = Dealers::find()->where(['role' => 'dealer'])->all();

    foreach ($model as $key => $value) {
        $data_dealers_1[$key] = $value->name;
        $data_dealers_2[$key] = array(
            "value" => 1,
            "name" => $value->name,
        );
    }



?>

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
                                    <div><?=$city->name?></div>
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
        <div class = "col-md-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="chart-container has-scroll">
                        <div class="chart has-fixed-height has-minimum-width" id="piedealers"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function () {
    require.config({
        paths: {
            echarts: '/profile/files/js/plugins/visualization/echarts'
        }
    });
    require(
        [
            'echarts',
            'echarts/theme/limitless',
            'echarts/chart/pie',
            'echarts/chart/funnel'
        ],

        function (ec, limitless) {

            var piedealers = ec.init(document.getElementById('piedealers'), limitless);

            dealersoptions = {

                title: {
                    text: 'Оборот по дилерам',
                    subtext: 'График отображает оборот по дилерам',
                    x: 'center'
                },
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                legend: {
                    orient: 'vertical',
                    x: 'left',
                    data: <?=json_encode($data_dealers_1)?>
                },

                toolbox: {
                    show: true,
                    orient: 'vertical',
                    feature: {
                        dataView: {
                            show: true,
                            readOnly: false,
                            title: 'Показать данные',
                            lang: ['View chart data', 'Закрыть', 'Обновить']
                        },
                        restore: {
                            show: true,
                            title: 'Обновить'
                        },
                        saveAsImage: {
                            show: true,
                            title: 'Сохранить как изображение',
                            lang: ['Save']
                        }
                    }
                },

                calculable: true,

                series: [{
                    name: 'Оборот по дилерам',
                    type: 'pie',
                    radius: '70%',
                    center: ['50%', '57.5%'],
                    data: <?=json_encode($data_dealers_2)?>
                }]
            };

            piedealers.setOption(dealersoptions);

            window.onresize = function () {
                setTimeout(function () {
                    piedealers.resize();
                }, 200);
            }
        }
    );
});
</script>