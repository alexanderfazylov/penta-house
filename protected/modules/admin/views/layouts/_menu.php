<?php
$controller = Yii::app()->controller->getId();
$action = Yii::app()->controller->getAction()->getId();
$this->widget('zii.widgets.CMenu', array(
    //
    'htmlOptions' => array('class' => 'nav nav-pills'),
    'items' => array(
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
            'url' => Yii::app()->urlManager->createUrl('/admin/main/index'),
            'active' => (($controller == 'main' && $action == 'inasddex'))
        ),
        array(
            'label' => 'Новости',
            'url' => Yii::app()->urlManager->createUrl('/admin/main/index'),
            'active' => (($controller == 'main' && $action == 'indeasdx'))
        ),
        array(
            'label' => 'Учетные данные',
            'url' => Yii::app()->urlManager->createUrl('/admin/main/index'),
            'active' => (($controller == 'main' && $action == 'indexasd'))
        ),

        array(
            'label' => 'Выход',
            'url' => Yii::app()->urlManager->createUrl('site/logout'),
        )
    ),
));
?>
