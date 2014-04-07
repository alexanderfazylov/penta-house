<?php
$controller = Yii::app()->controller->getId();
$action = Yii::app()->controller->getAction()->getId();
$this->widget('zii.widgets.CMenu', array(
    //
    'htmlOptions' => array('class' => 'nav nav-pills'),
    'items' => array(
        array(
            'label' => 'Главная',
            'url' => Yii::app()->urlManager->createUrl('/admin/default/index'),
            'active' => (($controller == 'default' && $action == 'index'))
        ),
        array(
            'label' => 'Производители',
            'url' => Yii::app()->urlManager->createUrl('/admin/main/index'),
            'active' => (($controller == 'main' && $action == 'index'))
        ),
        array(
            'label' => 'Коллекции',
            'url' => Yii::app()->urlManager->createUrl('/admin/main/collections'),
            'active' => (($controller == 'main' && $action == 'collections'))
        ),
        array(
            'label' => 'Проекты',
            'url' => Yii::app()->urlManager->createUrl('/admin/main/projects'),
            'active' => (($controller == 'main' && $action == 'projects'))
        ),
        array(
            'label' => 'Новости',
            'url' => Yii::app()->urlManager->createUrl('/admin/main/posts'),
            'active' => (($controller == 'main' && $action == 'posts'))
        ),
        array(
            'label' => 'Контактная информация',
            'url' => Yii::app()->urlManager->createUrl('/admin/main/contacts'),
            'active' => (($controller == 'main' && $action == 'contacts'))
        ),
        array(
            'label' => 'О компании',
            'url' => Yii::app()->urlManager->createUrl('/admin/main/about'),
            'active' => (($controller == 'main' && $action == 'about'))
        ),
    ),
));
?>
