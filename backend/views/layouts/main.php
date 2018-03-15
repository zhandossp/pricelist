<?php
    use backend\assets\AppAsset;
    use backend\components\Helpers;
    use yii\helpers\Html;
    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
        <head>
            <meta charset="<?= Yii::$app->charset ?>">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <?= Html::csrfMetaTags() ?>
            <title><?= Html::encode($this->title) ?></title>
            <?php $this->head() ?>
        </head>
        <body>
        <?php $this->beginBody() ?>
            <? if (Yii::$app->controller->action->id != "authentication") { ?>
                <? Helpers::CheckAuth("no-redirect", null); ?>
                <div class="navbar navbar-default header-highlight">
                    <div class="navbar-header">

                        <a class="navbar-brand" style = "color:#000;" href="javascript:void(0);"></a>

                        <ul class="nav navbar-nav visible-xs-block">
                            <li><a data-toggle="collapse" data-target="#navbar-mobile" class="legitRipple"><i class="icon-tree5"></i></a></li>
                            <li><a class="sidebar-mobile-main-toggle legitRipple"><i class="icon-paragraph-justify3"></i></a></li>
                        </ul>
                    </div>

                    <div class="navbar-collapse collapse" id="navbar-mobile">
                        <ul class="nav navbar-nav">
                            <li><a class="sidebar-control sidebar-main-toggle hidden-xs legitRipple"><i class="icon-paragraph-justify3"></i></a></li>

                        </ul>
                        <?
                            $roles = array("superadmin" => "супер-админ", "admin" => "администратор", "dealer" => "дилер", "seller" => "продавец");
                        ?>
                        <div class="navbar-right">
                            <p class="navbar-text">Здравствуйте  <?=Yii::$app->session->get('profile_fio')?>!</p>
                            <p class="navbar-text"><span class="label bg-success"><?=$roles[Yii::$app->session->get('profile_role')]?></span></p>
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-bell2"></i>
                                        <span class="visible-xs-inline-block position-right">Уведомления</span>
                                        <span class="status-mark border-orange-400"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-content">
                                        <div class="dropdown-content-heading">Уведомления</div>

                                        <ul class="media-list dropdown-content-body width-350">
                                            <li class="media">
                                                <div class="media-left">
                                                    <a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs"><i class="icon-cart"></i></a>
                                                </div>

                                                <div class="media-body">
                                                    Новая заявка в магазине "Магазин 1"
                                                    <div class="media-annotation">21.01.2018 19:02</div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-left">
                                                    <a href="#" class="btn bg-purple-300 btn-rounded btn-icon btn-xs"><i class="icon-truck"></i></a>
                                                </div>

                                                <div class="media-body">
                                                    Товар доставлен покупателю "Андрей"
                                                    <div class="media-annotation">21.01.2018 18:30</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="page-container">
                    <div class="page-content">
                        <div class="sidebar sidebar-main">
                            <div class="sidebar-content">
                                <div class="sidebar-user-material">
                                    <div class="category-content">
                                        <div class="sidebar-user-material-content">
                                            <a href="account" class = "cs-link"><img src="/profile/uploads/avatars/<?=Yii::$app->session->get('profile_avatar')?>" class="account_avatar img-responsive" alt=""></a>
                                            <h6><?=Yii::$app->session->get('profile_fio')?></h6>
                                            <span class="text-size-small text-muted"><?=$roles[Yii::$app->session->get('profile_role')]?></span>
                                        </div>

                                        <div class="sidebar-user-material-menu">
                                            <a href="#user-nav" data-toggle="collapse"><span>Мой профиль</span> <i class="caret"></i></a>
                                        </div>
                                    </div>

                                    <div class="navigation-wrapper collapse" id="user-nav">
                                        <ul class="navigation">
                                            <li><a href="account" class = "cs-link"><i class="icon-cog5"></i> <span>Настройки аккаунта</span></a></li>
                                            <li><a href="/profile/logout/"><i class="icon-switch2"></i> <span>Выход</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <?=$this->render('/layouts/mainmenu')?>
                            </div>
                        </div>
                        <div id = "dynamic_content" class="content-wrapper"></div>
                    </div>
                </div>
            <? } else { ?>
                <?=$this->render('/layouts/authentication'); ?>
            <? } ?>
        <?php $this->endBody() ?>
        </body>
    </html>
<?php $this->endPage() ?>
