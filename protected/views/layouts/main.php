<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="language" content="ru"/>
</head>

<body>
<div class="wrapper">
    <div class="aside">
        <div class="aside-content">
            <div class="aside-header">
                <div class="city">
                    <span class="city-name">Казань</span>
                    <span class="change-city">Выбрать другой город</span>
                </div>
                <div class="phone">+7 (843) 567-98-01</div>
                <div class="callback">Заказать обратный звонок</div>
            </div>
            <div class="aside-menu">
                <div class="logo">
                    <a href="/site/index">
                        <div class="logo-p">PENTA</div>
                        <div class="logo-h">HOUSE</div>
                    </a>

                    <div class="logo-description">Элитная сантехника, плитка.<br> Продажа. Монтаж. Сервис.</div>
                </div>
                <?php $this->renderPartial('application.views.layouts._menu'); ?>
            </div>
        </div>
        <div class="aside-footer">
            <div class="aside-footer-wrapper">
                <div class="social">
                    <a href="#" class="vk"></a>
                    <a href="#" class="fc"></a>
                    <a href="#" class="tw"></a>
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

