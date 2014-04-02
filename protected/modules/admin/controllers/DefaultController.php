<?php

class DefaultController extends Controller
{
    public $cs;
    
    public function init()
    {
        if (Yii::app()->user->isGuest) {
            Yii::app()->getController()->redirect('/site/login');
            Yii::app()->end();
        }
        $this->cs = Yii::app()->clientScript;
        //js
        $this->cs->registerCoreScript('jquery');
        $this->cs->registerScriptFile($this->createUrl('/dist/bootstrap-3.1.1-dist/js/bootstrap.min.js'));
        $this->cs->registerScriptFile($this->createUrl('/dist/bootstrap-modal/js/bootstrap-modalmanager.js'));
        $this->cs->registerScriptFile($this->createUrl('/dist/bootstrap-modal/js/bootstrap-modal.js'));
        $this->cs->registerScriptFile($this->createUrl('/dist/jGrowl/jquery.jgrowl.min.js'));
        $this->cs->registerScriptFile($this->createUrl('/dist/jsrender.min.js'));
        $this->cs->registerScriptFile($this->createUrl('/dist/file-uploader/fileuploader.js'));
        $this->cs->registerScriptFile($this->createUrl('/dist/Jcrop/js/jquery.Jcrop.min.js'));
        $this->cs->registerScriptFile($this->createUrl('/dist/nprogress/nprogress.js'));
        //
        $this->cs->registerScriptFile($this->createUrl('/js/app.js'));
        $this->cs->registerScriptFile($this->createUrl('/js/admin.js'));
        //css
        $this->cs->registerCssFile($this->createUrl('/dist/bootstrap-3.1.1-dist/css/bootstrap.min.css'));
        $this->cs->registerCssFile($this->createUrl('/dist/bootstrap-3.1.1-dist/css/bootstrap-theme.min.css'));
        $this->cs->registerCssFile($this->createUrl('/dist/bootstrap-modal/css/bootstrap-modal-bs3patch.css'));
        $this->cs->registerCssFile($this->createUrl('/dist/bootstrap-modal/css/bootstrap-modal.css'));
        $this->cs->registerCssFile($this->createUrl('/dist/jGrowl/jquery.jgrowl.min.css'));
        $this->cs->registerCssFile($this->createUrl('/dist/file-uploader/fileuploader.css'));
        $this->cs->registerCssFile($this->createUrl('/dist/Jcrop/css/jquery.Jcrop.min.css'));
        $this->cs->registerCssFile($this->createUrl('/dist/nprogress/nprogress.css'));
        //
        $this->cs->registerCssFile($this->createUrl('/css/admin.css'));
    }

    public function actionIndex()
    {
        $this->render('index');
    }
}