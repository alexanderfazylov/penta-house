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
//        array(
//            'label' => 'Дилерство',
//            'url' => ('/site/dealership'),
//            'active' => (($controller == 'site' && $action == 'dealership'))
//        ),
        array(
            'label' => 'Каталог',
            'url' => ('/site/catalog'),
            'active' => (
                ($controller == 'site' && $action == 'catalog') ||
                ($controller == 'site' && $action == 'brand')
                )
        ),
        array(
            'label' => 'Проекты',
            'url' => ('/site/projects'),
            'active' => (
                    ($controller == 'site' && $action == 'projects') ||
                    ($controller == 'site' && $action == 'project')
                )
        ),
        array(
            'label' => 'Контакты',
            'url' => ('/site/contact'),
            'active' => (($controller == 'site' && $action == 'contact'))
        ),
    ),));
?>