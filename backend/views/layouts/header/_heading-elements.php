<div class="heading-elements">
    <div class="heading-btn-group">
        <? if ($page == "products") { ?>
            <a data-id = "0" href="products/form-product" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить товар<span class="legitRipple-ripple"></span></a>
        <? } else if ($page == "dealers") { ?>
            <a data-id = "0" href="dealers/form-dealer" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить дилера<span class="legitRipple-ripple"></span></a>
        <? } else if ($page == "admins") { ?>
            <a data-id = "0" href="admins/form-admin" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить администратора<span class="legitRipple-ripple"></span></a>
        <? } else if ($page == "sellers") { ?>
            <a data-id = "0" href="sellers/form-seller" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить продавца<span class="legitRipple-ripple"></span></a>
        <? } else if ($page == "geo") { ?>
            <a data-id = "0" href="geo/form-geo" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить страну<span class="legitRipple-ripple"></span></a>
        <? } else if ($page == "params") { ?>
            <a data-id = "0" href="params/form-param" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить характеристику<span class="legitRipple-ripple"></span></a>
        <? } else if ($page == "cities") { ?>
            <a data-id = "0" href="cities/form-city" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить город<span class="legitRipple-ripple"></span></a>
        <? } else if ($page == "countries") { ?>
            <a data-id = "0" href="countries/form-country" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить страну<span class="legitRipple-ripple"></span></a>
        <? } else if ($page == "shops") { ?>
            <a data-id = "0" href="shops/form-shop" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить магазин<span class="legitRipple-ripple"></span></a>
        <? } else if ($page == "clients") { ?>
            <a data-id = "0" href="clients/form-client" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить клиента<span class="legitRipple-ripple"></span></a>
        <? } else if ($page == "boxers") { ?>
            <a data-id = "0" href="boxers/form-boxer" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить боксера<span class="legitRipple-ripple"></span></a>
        <? } else if ($page == "news") { ?>
            <a data-id = "0" href="news/form-news" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить новость<span class="legitRipple-ripple"></span></a>
        <? } else if ($page == "associate") { ?>
            <a data-id = "0" href="associate/form-associate" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить сотрудника<span class="legitRipple-ripple"></span></a>
        <? } else if ($page == "value") { ?>
            <a data-id = "0" href="value/form-value" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить значение<span class="legitRipple-ripple"></span></a>
        <? } else if ($page == "filters") { ?>
            <a data-id = "0" href="filters/form-filters" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить фильтр<span class="legitRipple-ripple"></span></a>
        <? } else if ($page == "pricelist") { ?>
            <a data-id = "0" href="pricelist/form-pricelist" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Поплнить прайслист<span class="legitRipple-ripple"></span></a>
        <? } ?>
    </div>
</div>
