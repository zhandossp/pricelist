<? use backend\components\Helpers; ?>

<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">
            <li class="navigation-header"><span>Администрирование</span> <i class="icon-menu" title="Администрирование"></i></li>
            <? if (Helpers::GetRangeAccess(array("superadmin"))) { ?>
                <li><a id = "admins" href="admins" class = "cs-link"><i class="icon-users2"></i> <span>Администраторы</span></a></li>
            <? } ?>
            <? if (Helpers::GetRangeAccess(array("admin", "superadmin"))) { ?>
                <li><a id = "dealers" href="dealers" class = "cs-link"><i class="icon-man-woman"></i> <span>Дилеры</span></a></li>
            <? } ?>
            <? if (Helpers::GetRangeAccess(array("superadmin", "admin", "dealer"))) { ?>
                <li><a id = "sellers" href="sellers" class = "cs-link"><i class="icon-reading"></i> <span>Продавцы</span></a></li>
            <? } ?>
            <? if (Helpers::GetRangeAccess(array("superadmin", "admin", "dealer", "seller"))) { ?>
                <li><a id = "shops" href="shops" class = "cs-link"><i class="icon-store2"></i> <span>Магазины</span></a></li>
                <li><a id = "products" href="products" class = "cs-link"><i class="icon-cart"></i> <span>Товары</span></a></li>
            <? } ?>
            <? if (Helpers::GetRangeAccess(array("superadmin"))) { ?>
                <li class="navigation-header"><span>Остальное</span> <i class="icon-menu" title="Остальное"></i></li>
                <li>
                    <a href="#"><i class="icon-gear"></i> <span>Настройки</span></a>
                    <ul>
                        <li><a id = "cities" href="cities" class = "cs-link">Города</a></li>
                        <li><a id = "sections" href="sections" class = "cs-link">Категории</a></li>
                        <li><a id = "params" href="params" class = "cs-link">Характеристики</a></li>
                    </ul>
                </li>
            <? } ?>
            <li>
                <a href="#"><i class="icon-statistics"></i> <span>Статистика</span></a>
                <ul>
                    <? if (Helpers::GetRangeAccess(array("superadmin", "admin"))) { ?>
                        <li><a id = "sections" href="sections" class = "cs-link">По дилерам</a></li>
                    <? } ?>
                    <? if (Helpers::GetRangeAccess(array("superadmin", "admin", "dealer"))) { ?>
                        <li><a id = "params" href="params" class = "cs-link">По продавцам</a></li>
                    <? } ?>
                    <? if (Helpers::GetRangeAccess(array("superadmin", "admin", "dealer", "seller"))) { ?>
                        <li><a id = "params" href="params" class = "cs-link">По магазинам</a></li>
                        <li><a id = "params" href="params" class = "cs-link">По покупателям</a></li>
                    <? } ?>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-bars-alt"></i> <span>Общая статистика</span></a>
                <ul>
                    <? if (Helpers::GetRangeAccess(array("superadmin", "admin"))) { ?>
                        <li><a id = "stats-dealers" href="stats-dealers" class = "cs-link">По дилерам</a></li>
                    <? } ?>
                    <? if (Helpers::GetRangeAccess(array("superadmin", "admin", "dealer"))) { ?>
                        <li><a id = "stats-sellers" href="stats-sellers" class = "cs-link">По продавцам</a></li>
                    <? } ?>
                    <? if (Helpers::GetRangeAccess(array("superadmin", "admin", "dealer", "seller"))) { ?>
                        <li><a id = "stats-shops" href="stats-shops" class = "cs-link">По магазинам</a></li>
                    <? } ?>
                </ul>
            </li>
            <li class="navigation-header"><span>Приложение</span> <i class="icon-menu" title="Приложение"></i></li>
            <? if (Helpers::GetRangeAccess(array("superadmin"))) { ?>
                <li><a id = "users" href="users" class = "cs-link"><i class="icon-man-woman"></i> <span>Пользователи</span></a></li>
            <? } ?>
            <li><a id = "orders" href="orders" class = "cs-link"><i class="icon-bag"></i> <span>Заявки</span></a></li>
        </ul>
    </div>
</div>