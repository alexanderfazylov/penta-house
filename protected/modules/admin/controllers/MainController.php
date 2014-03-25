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
        $this->cs->registerScriptFile($this->createUrl('/dist/bootstrap-3.1.1-dist/js/bootstrap.min.js'));
        $this->cs->registerScriptFile($this->createUrl('/dist/jsrender.min.js'));
        $this->cs->registerScriptFile($this->createUrl('/js/app.js'));
        $this->cs->registerScriptFile($this->createUrl('/js/admin.js'));

        $this->cs->registerCssFile($this->createUrl('/dist/bootstrap-3.1.1-dist/css/bootstrap.min.css'));
        $this->cs->registerCssFile($this->createUrl('/dist/bootstrap-3.1.1-dist/css/bootstrap-theme.min.css'));
        $this->cs->registerCssFile($this->createUrl('/css/admin.css'));
    }

    public function actionIndex()
    {

        $this->render('index');
    }

    public function actionBrand()
    {

        var_dump($_POST);
    }
}