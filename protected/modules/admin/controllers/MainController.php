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
        $this->cs->registerCoreScript('jquery.ui');

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
        $this->cs->registerCssFile($this->createUrl('/css/jquery-ui.css'));
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
        $brand->maine_page_visible = (isset($_POST['Brand']['maine_page_visible'])) ? 1 : 0;

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

    public function actionGetBrends()
    {
        $criteria = new CDbCriteria;

        $criteria->order = 't.maine_page_visible ASC, t.order ASC';

        echo Helper::convertModelToJson(Brand::model()->findAll($criteria));
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


    public function actionCollection()
    {


        if (!isset($_POST['Collection'])) {
            $response = array(
                'status' => 'error',
            );
            Yii::app()->end();
        }

        if (!empty($_POST['Collection']['id'])) {
            $collection = Collection::model()->findByPk($_POST['Collection']['id']);
        } else {
            $collection = new Collection();
        }


        $collection->attributes = $_POST['Collection'];
        $collection->maine_page_visible = (isset($_POST['Collection']['maine_page_visible'])) ? 1 : 0;
        $collection->sanitary_engineering = (isset($_POST['Collection']['sanitary_engineering'])) ? 1 : 0;
        $collection->tile = (isset($_POST['Collection']['tile'])) ? 1 : 0;


        if (!$collection->save()) {
            $response = array(
                'status' => 'error',
                'model' => array("Collection" => $collection->getErrors())
            );
            echo CJSON::encode($response);
            Yii::app()->end();
        }


        if (isset($_POST['CollectionUpload']['files'])) {
            $new_collection_uploads = $_POST['CollectionUpload']['files'];

            $cu_models = CollectionUpload::model()->findAllByAttributes(array('collection_id' => $collection->id));

            foreach ($cu_models as $model) {
                if (isset($new_collection_uploads[$model->upload_id])) {
                    unset($new_collection_uploads[$model->upload_id]);
                }
            }

            foreach ($new_collection_uploads as $upload_id) {
                $cu = new CollectionUpload();
                $cu->upload_id = $upload_id;
                $cu->collection_id = $collection->id;
                $cu->save();
            }


        }


        MetaData::addSelf($collection);


    }

    public function actionDeleteCollection($id)
    {
        Collection::model()->deleteByPk($id);
        $response = array(
            'status' => 'success',
            'message' => 'Коллекция удалена',
        );
        echo CJSON::encode($response);
    }

    public function actionDeleteProject($id)
    {
        Project::model()->deleteByPk($id);
        $response = array(
            'status' => 'success',
            'message' => 'Проект удален',
        );
        echo CJSON::encode($response);
    }


    public function actionProjects()
    {
        $project = new Project('search');

        if (isset($_GET['Project'])) {
            $project->attributes = $_GET['Project'];
        }

        $this->render('projects', array('project' => $project));
    }


    public function actionProject()
    {


        if (!isset($_POST['Project'])) {
            $response = array(
                'status' => 'error',
            );
            Yii::app()->end();
        }

        if (!empty($_POST['Project']['id'])) {
            $project = Project::model()->findByPk($_POST['Project']['id']);
        } else {
            $project = new Project();
        }


        $project->attributes = $_POST['Project'];
        $project->visible = (isset($_POST['Project']['visible'])) ? 1 : 0;


        if (!$project->save()) {
            $response = array(
                'status' => 'error',
                'model' => array("Project" => $project->getErrors())
            );
            echo CJSON::encode($response);
            Yii::app()->end();
        }


        if (isset($_POST['ProjectUpload']['files'])) {
            $new_collection_uploads = $_POST['ProjectUpload']['files'];

            $cu_models = ProjectUpload::model()->findAllByAttributes(array('project_id' => $project->id));

            foreach ($cu_models as $model) {
                if (isset($new_collection_uploads[$model->upload_id])) {
                    unset($new_collection_uploads[$model->upload_id]);
                }
            }

            foreach ($new_collection_uploads as $upload_id) {
                $cu = new ProjectUpload();
                $cu->upload_id = $upload_id;
                $cu->project_id = $project->id;
                $cu->save();
            }


        }


        MetaData::addSelf($project);


    }


}