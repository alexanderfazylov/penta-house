<?php
$active_1 = '';
$active_2 = '';
$active_3 = '';
$active_4 = '';
$active_5 = '';

if (Yii::app()->controller->getAction()->getId() == 'about') {
    $active_1 = 'class="active"';
} else if (Yii::app()->controller->getAction()->getId() == '') {
    $active_2 = 'class="active"';
} else if (Yii::app()->controller->getAction()->getId() == 'catalog' ||
    Yii::app()->controller->getAction()->getId() == 'brand' ||
    Yii::app()->controller->getAction()->getId() == 'collection'
) {
    $active_3 = 'class="active"';
} else if (Yii::app()->controller->getAction()->getId() == '') {
    $active_4 = 'class="active"';
} else if (Yii::app()->controller->getAction()->getId() == 'contact') {
    $active_5 = 'class="active"';
}
?>

<ul class="menu">
    <li <?php echo $active_1; ?>>
        <a href="/site/about">О компании</a>
    </li>
    <li <?php echo $active_2; ?>>
        <a href="#">Дилерство</a>
    </li>
    <li <?php echo $active_3; ?>>
        <a href="/site/catalog">Каталог</a>
    </li>
    <li <?php echo $active_4; ?>>
        <a href="#">Проекты</a>
    </li>
    <li <?php echo $active_5; ?>>
        <a href="/site/contact">Контакты</a>
    </li>
</ul>