<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title><?php echo(!empty($this->pageTitle) ? $this->pageTitle : Yii::app()->name); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="language" content="ru"/>
    <meta name="description" content="<?php echo $this->description; ?>">
    <meta name="keywords" content="<?php echo $this->keywords; ?>">

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function () {
                try {
                    w.yaCounter25284743 = new Ya.Metrika({id: 25284743,
                        webvisor: true,
                        clickmap: true,
                        trackLinks: true,
                        accurateTrackBounce: true});
                } catch (e) {
                }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () {
                    n.parentNode.insertBefore(s, n);
                };
            s.type = "text/javascript";
            s.async = true;
            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "yandex_metrika_callbacks");
    </script>
</head>

<body>
<div class="wrapper">
    <div class="aside">
        <div class="aside-content">
            <div class="aside-header">
                <div class="city">
                    <span
                        class="city-name"><?php echo Helper::getCity($this->contacts, $this->active_contact_id); ?></span>
                    <?php if (count($this->contacts) >= 2): ?>
                        <div class="anchor"></div>
                        <span class="change-city">Выбрать другой город</span>
                        <div class="anchor"></div>

                    <?php endif; ?>
                </div>
                <div class="phone"><?php echo Helper::getPhone($this->contacts, $this->active_contact_id); ?></div>
                <div class="callback">Заказать обратный звонок</div>
            </div>
        </div>
        <div class="aside-menu">
            <div class="logo">
                <a href="/">
                    <img src="../../../i/logo.png">
                </a>

                <div class="logo-description">Элитная сантехника, плитка.<br> Продажа. Монтаж. Сервис.</div>
            </div>
            <?php $this->renderPartial('application.views.layouts._menu'); ?>
        </div>

        <div class="aside-footer">
            <div class="aside-footer-wrapper">
                <div class="social">
                    <?php if (!empty($this->main->vk_link)): ?>
                        <a href="<?php echo $this->main->vk_link; ?>" class="vk"></a>
                    <?php endif ?>

                    <?php if (!empty($this->main->fb_link)): ?>
                        <a href="<?php echo $this->main->fb_link; ?>" class="fc"></a>
                    <?php endif ?>

                    <?php if (!empty($this->main->tw_link)): ?>
                        <a href="<?php echo $this->main->tw_link; ?>" class="tw"></a>
                    <?php endif ?>
                </div>
                <div class="copyright">&copy; 2013-<?php echo date('o'); ?>  Penta House</div>
            </div>
        </div>
    </div>
    <div id="pt-main" class="content">
        <?php $this->renderPartial('application.views.layouts._callback'); ?>
        <?php $this->renderPartial('application.views.layouts._change_city'); ?>
        <?php if ($this->carousel_panel) $this->renderPartial('application.views.layouts._carousel_panel'); ?>
        <?php echo $content; ?>
    </div>
</div>
<script src="/js/pagetransitions.js"></script>
</body>
</html>

<script>
    var contacts = <?php echo Helper::convertModelToJson($this->contacts); ?>;
    var active_contact_id = <?php echo $this->active_contact_id;?>;
</script>