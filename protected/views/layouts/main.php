<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="language" content="ru"/>
    <meta name="description" content="<?php echo $this->description; ?>">
    <meta name="keywords" content="<?php echo $this->keywords; ?>">

</head>

<body>
<div class="wrapper">
    <div class="aside">
        <div class="aside-content">
            <div class="aside-header">
                <div class="city">
                    <span
                        class="city-name"><?php echo Helper::getCity($this->contacts, $this->active_contact_id); ?></span>
                    <span class="change-city">Выбрать другой город</span>
                </div>
                <div class="phone"><?php echo Helper::getPhone($this->contacts, $this->active_contact_id); ?></div>
                <div class="callback">Заказать обратный звонок</div>
            </div>
            <div class="aside-menu">
                <div class="logo">
                    <a href="/site/index">
                        <img src="../../../i/logo.png">
                    </a>

                    <div class="logo-description">Элитная сантехника, плитка.<br> Продажа. Монтаж. Сервис.</div>
                </div>
                <?php $this->renderPartial('application.views.layouts._menu'); ?>
            </div>
        </div>
        <div class="aside-footer">
            <div class="aside-footer-wrapper">
                <div class="social">
                    <a href="<?php echo $this->main->vk_link; ?>" class="vk"></a>
                    <a href="<?php echo $this->main->fb_link; ?>" class="fc"></a>
                    <a href="<?php echo $this->main->tw_link; ?>" class="tw"></a>
                </div>
                <div class="copyright">&copy; 2013 Penta House</div>
            </div>
        </div>
    </div>
    <div class="content">
        <?php $this->renderPartial('application.views.layouts._callback'); ?>
        <?php $this->renderPartial('application.views.layouts._change_city'); ?>
        <?php echo $content; ?>
        <div class="anchor"></div>
    </div>
</div>
</body>
</html>
<script>
    var contacts = <?php echo Helper::convertModelToJson($this->contacts); ?>;
    var active_contact_id = <?php echo $this->active_contact_id;?>;
</script>