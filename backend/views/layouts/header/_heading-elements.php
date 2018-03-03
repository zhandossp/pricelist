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
        <? } else if ($page == "shops") { ?>
            <a data-id = "0" href="shops/form-shop" class="action-link btn bg-success btn-labeled heading-btn legitRipple"><b><i class="icon-plus2"></i></b> Добавить магазин<span class="legitRipple-ripple"></span></a>
        <? } ?>
    </div>
</div>
