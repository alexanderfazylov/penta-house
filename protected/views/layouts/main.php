<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <link rel="stylesheet" type="text/css" href ="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="/js/script.js"></script>
</head>

<body>
    <div class="header">
        <div class="city">
            <div class="current-city">Казань</div>
            <!--<div class="choose-city">Выбрать другой город</div>-->
        </div>
        <div class="phone">
            <div class="phone-number">+7 (843) 567-98-01</div>
            <!--<div class="order-callback">Заказать обратный звонок</div>-->
        </div>
        <a id="logo" href="/index.php"></a>
        <div class="slogan">Элитная сантехника, плитка.</br>Продажа. Монтаж. Сервис.</div>
        <div class="logo-line"></div>
        <div class="menu">
            <a href="/index.php?r=site/about">О компании</a>
            <!--<a href="dealership.html">Дилерство</a>-->
            <!--<a href="about.html">Каталог</a>-->
            <!--<a href="projects.html">Проекты</a>-->
            <a href="/index.php?r=site/contact">Контакты</a>
        </div>
        <div class="footer">
            <!--
            <div class="social-networks">
                <a class="vk" href="vk.com"></a>
                <a class="fb" href="facebook.com"></a>
                <a class="tw" href="twitter.com"></a>
            </div>
            -->
            <div class="footer-line"></div>
            <div class="copyright">&copy; 2013 Penta House</div>
        </div>
    </div>

	<?php echo $content; ?>

    </body>
</html>
