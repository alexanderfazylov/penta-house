<?php

class MainController extends Controller
{
    public $layout = 'main';

    public $cs;

    public function init()
    {
        if (Yii::app()->user->isGuest) {
            Yii::app()->getController()->redirect('/site/login');
            Yii::app()->end();
        }
        $this->cs = Yii::app()->clientScript;

        $this->cs->registerCoreScript('jquery');
        $this->cs->registerScriptFile($this->createUrl('/js/app.js'));
        $this->cs->registerScriptFile($this->createUrl('/dist/bootstrap-3.1.1-dist/js/bootstrap.min.js'));

        $this->cs->registerCssFile($this->createUrl('/dist/bootstrap-3.1.1-dist/css/bootstrap.min.css'));
        $this->cs->registerCssFile($this->createUrl('/dist/bootstrap-3.1.1-dist/css/bootstrap-theme.min.css'));
        //$this->cs->registerCssFile($this->createUrl('/css/style.css'));
    }

    public function actionIndex()
    {

        $this->render('index');
    }

    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'inlineFilterName',
            array(
                'class'=>'path.to.FilterClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }

    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    */
}