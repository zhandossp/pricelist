<? use backend\components\Helpers; ?>

<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">
            <li class="navigation-header"><span>Администрирование</span> <i class="icon-menu" title="Администрирование"></i></li>
            <? if (Helpers::GetRangeAccess(array("superadmin", "admin", "associate"))) { ?>
                <li><a id = "associate" href="associate" class = "cs-link"><i class="icon-users2"></i> <span>Сотрудники</span></a></li>
            <? } ?>
            <? if (Helpers::GetRangeAccess(array("superadmin", "admin", "associate"))) { ?>
                <li><a id = "sections" href="sections" class = "cs-link"><i class="icon-add-to-list"></i> <span>Фильтры</span></a></li>
            <? } ?>
            <? if (Helpers::GetRangeAccess(array("superadmin", "admin", "dealer", "seller"))) { ?>
                <li><a id = "pricelist" href="pricelist" class = "cs-link"><i class="icon-list3"></i> <span>Прайслист</span></a></li>
            <? } ?>
        </ul>
    </div>
</div>