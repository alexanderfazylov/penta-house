<?php
$controller = Yii::app()->controller->getId();
$action = Yii::app()->controller->getAction()->getId();

$this->widget('zii.widgets.CMenu', array(
    'htmlOptions' => array('class' => 'menu'),
    'items' => array(
        array(
            'label' => 'О компании',
            'url' => ('/site/about'),
            'active' => (($controller == 'site' && $action == 'about'))
        ),
        array(
            'label' => 'Дилерство',
            'url' => ('#'),
            'active' => (($controller == 'default' && $action == 'index'))
        ),
        array(
            'label' => 'Каталог',
            'url' => ('/site/catalog'),
            'active' => (($controller == 'site' && $action == 'catalog'))
        ),
        array(
            'label' => 'Проекты',
            'url' => ('#'),
            'active' => (($controller == 'default' && $action == 'index'))
        ),
        array(
            'label' => 'Контакты',
            'url' => ('/site/contact'),
            'active' => (($controller == 'site' && $action == 'contact'))
        ),
    ),));
?>