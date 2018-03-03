<? use backend\components\Helpers; ?>

<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">
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
            <? if (Helpers::GetRangeAccess(array("superadmin", "admin"))) { ?>
                <li class="navigation-header"><span>Остальное</span> <i class="icon-menu" title="Остальное"></i></li>
                <li>
                    <a href="#"><i class="icon-gear"></i> <span>Настройки</span></a>
                    <ul>
                        <!--<li><a id = "geo" href="geo" class = "cs-link"><i class="icon-map4"></i> Страны и города</a></li>-->
                        <li><a id = "sections" href="sections" class = "cs-link"><i class="icon-git-branch"></i> Категории</a></li>
                        <li><a id = "params" href="params" class = "cs-link"><i class="icon-list"></i> Характеристики</a></li>
                    </ul>
                </li>
            <? } ?>
            <!--<li><a id = "products" href="products" class = "cs-link"><i class="icon-cart5"></i> <span>Мои товары</span></a></li>-->
        </ul>
    </div>
</div>