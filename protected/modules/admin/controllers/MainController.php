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
        $brand = new Brand('search');
        if (isset($_GET['Brand'])) {
            $brand->attributes = $_GET['Brand'];
        }

        $this->render('index', array('brand' => $brand));
    }

    public function actionBrand()
    {
        if (!isset($_POST['Brand'])) {
            $response = array(
                'status' => 'error',
            );
            Yii::app()->end();
        }

        if (!empty($_POST['Brand']['id'])) {
            $brand = Brand::model()->findByPk($_POST['Brand']['id']);
        } else {
            $brand = new Brand();
        }

        $brand->attributes = $_POST['Brand'];
        if (isset($_POST['Brand']['maine_page_visible'])) {
            $brand->maine_page_visible = 1;
        } else {
            $brand->maine_page_visible = 0;
        }

        if (!$brand->save()) {
            $response = array(
                'status' => 'error',
                'model' => array("Brand" => $brand->getErrors())
            );
            echo CJSON::encode($response);
            Yii::app()->end();
        }

        MetaData::addSelf($brand);


    }

    public function actionCollections()
    {
        $collection = new Collection('search');

        if (isset($_GET['Collection'])) {
            $collection->attributes = $_GET['Collection'];
        }
        $this->render('collections', array('collection' => $collection));
    }

    public function actionDeleteBrand($id)
    {
        Brand::model()->deleteByPk($id);
        $response = array(
            'status' => 'success',
            'message' => 'Производитель удален',
        );
        echo CJSON::encode($response);
    }
}