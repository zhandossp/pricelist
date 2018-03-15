<?php
    $page = Yii::$app->session->get('navigation_page');
    $arr_page = explode("/", $page);
    if ($model == null) {
        $links = array(
            "account" => "Настройки аккаунта",
            "products" => "Товары",
            "form-product" => "Добавить товар",
            "dealers" => "Дилеры",
            "form-dealer" => "Добавить дилера",
            "admins" => "Администраторы",
            "form-admin" => "Добавить администратора",
            "sellers" => "Продавцы",
            "form-seller" => "Добавить продавца",
            "shops" => "Магазины",
            "form-shop" => "Добавить магазин",
            "geo" => "Страны и города",
            "sections" => "Категории",
            "form-section" => "Добавить категорию",
            "categories" => "Разделы",
            "form-category" => "Добавить раздел",
            "subcategories" => "Подразделы",
            "form-subcategory" => "Добавить подраздел",
            "params" => "Характеристики товаров",
            "form-param" => "Добавить характеристику",
            "users" => "Пользователи",
            "form-user" => "Добавить пользователя",
            "cities" => "Города",
            "form-city" => "Добавить город",
            "stats-dealers" => "Общая статистика по дилерам",
            "stats-sellers" => "Общая статистика по продавцам",
            "stats-shops" => "Общая статистика по магазинам",
        );
    } else {
        $links = array(
            "account" => "Настройки аккаунта",
            "products" => "Товары",
            "form-product" => "Редактировать товар",
            "dealers" => "Дилеры",
            "form-dealer" => "Редактировать дилера",
            "admins" => "Администраторы",
            "form-admin" => "Редактировать администратора",
            "sellers" => "Продавцы",
            "form-seller" => "Редактировать продавца",
            "shops" => "Магазины",
            "form-shop" => "Редактировать магазин",
            "sections" => "Категории",
            "form-section" => "Редактировать категорию",
            "categories" => "Разделы",
            "form-category" => "Редактировать раздел",
            "subcategories" => "Подразделы",
            "form-subcategory" => "Редактировать подраздел",
            "params" => "Характеристики товаров",
            "form-param" => "Редактировать характеристику",
            "users" => "Пользователи",
            "form-user" => "Редактировать пользователя",
            "cities" => "Города",
            "form-city" => "Редактировать город",
        );
    }
    $bread = '<li><a href="/profile/"><i class="icon-home2 position-left"></i> Главная</a></li>';
    $counter = 0;
    foreach ($arr_page as $value) {
        $counter++;
        if ($counter != count($arr_page)) {
            $bread .= '<li><a class = "cs-link" href="'.$value.'">' . $links[$value] . '</a></li>';
        } else {
            $bread .= '<li class = "active">' . $links[$value] . '</li>';
            $title = $links[$value];
        }
    }
?>

<div class="page-header">
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4>
                    <? if (count($arr_page) > 1) { ?>
                        <a class = "cs-link" href="<?=Yii::$app->request->cookies['back']?>"><i class="icon-arrow-left52 position-left"></i></a>
                    <? } ?>
                    <span class="text-semibold"><?=$title?></span>
                </h4>
            </div>
            <?=$this->render('/layouts/header/_heading-elements', array("page" => $page));?>
        </div>

        <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
            <ul class="breadcrumb">
                <?=$bread?>
            </ul>
        </div>
    </div>
</div>