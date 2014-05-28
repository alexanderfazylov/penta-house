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
        Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');

        $brand = new Brand('search');
        if (isset($_GET['Brand'])) {
            $brand->attributes = $_GET['Brand'];
        }
        $page = Page::model()->findByAttributes(array('name' => Page::PAGE_CATALOG));
        $this->render('index', array('brand' => $brand, 'page' => $page));
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
        Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');

        $collection = new Collection('search');

        if (isset($_GET['Collection'])) {
            $collection->attributes = $_GET['Collection'];
        } else {
            $collection->index_slider = '';
        }

        $this->render('collections', array('collection' => $collection));
    }

    public function actionGetBrends()
    {
        $criteria = new CDbCriteria;

        $criteria->order = 't.name ASC';

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
        Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
        $project = new Project('search');

        if (isset($_GET['Project'])) {
            $project->attributes = $_GET['Project'];
        }
        $page = Page::model()->findByAttributes(array('name' => Page::PAGE_PROJECTS));
        $this->render('projects', array('project' => $project, 'page' => $page));
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


    public function actionPosts()
    {
        Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
        $post = new Post('search');

        if (isset($_GET['Post'])) {
            $post->attributes = $_GET['Post'];
        }

        $page = Page::model()->findByAttributes(array('name' => Page::PAGE_POSTS));
        $this->render('posts', array('post' => $post, 'page' => $page));
    }


    public function actionPost()
    {


        if (!isset($_POST['Post'])) {
            $response = array(
                'status' => 'error',
            );
            Yii::app()->end();
        }

        if (!empty($_POST['Post']['id'])) {
            $post = Post::model()->findByPk($_POST['Post']['id']);
        } else {
            $post = new Post();
        }


        $post->attributes = $_POST['Post'];
        $post->visible = (isset($_POST['Post']['visible'])) ? 1 : 0;


        if (!$post->save()) {
            $response = array(
                'status' => 'error',
                'model' => array("Post" => $post->getErrors())
            );
            echo CJSON::encode($response);
            Yii::app()->end();
        }


        if (isset($_POST['PostUpload']['files'])) {
            $new_collection_uploads = $_POST['PostUpload']['files'];

            $cu_models = PostUpload::model()->findAllByAttributes(array('post_id' => $post->id));

            foreach ($cu_models as $model) {
                if (isset($new_collection_uploads[$model->upload_id])) {
                    unset($new_collection_uploads[$model->upload_id]);
                }
            }

            foreach ($new_collection_uploads as $upload_id) {
                $cu = new PostUpload();
                $cu->upload_id = $upload_id;
                $cu->post_id = $post->id;
                $cu->save();
            }
        }

        MetaData::addSelf($post);
    }

    public function actionDeletePost($id)
    {
        Post::model()->deleteByPk($id);
        $response = array(
            'status' => 'success',
            'message' => 'Новость удален',
        );
        echo CJSON::encode($response);
    }


    public function actionContacts()
    {
        $contact = new Contact('search');

        if (isset($_GET['Contact'])) {
            $contact->attributes = $_GET['Contact'];
        }
        $page = Page::model()->findByAttributes(array('name' => Page::PAGE_CONTACT));
        $this->render('contacts', array('contact' => $contact, 'page' => $page));
    }

    public function actionContact()
    {


        if (!isset($_POST['Contact'])) {
            $response = array(
                'status' => 'error',
            );
            Yii::app()->end();
        }

        if (!empty($_POST['Contact']['id'])) {
            $contact = Contact::model()->findByPk($_POST['Contact']['id']);
        } else {
            $contact = new Contact();
        }


        $contact->attributes = $_POST['Contact'];
        $contact->visible = (isset($_POST['Contact']['visible'])) ? 1 : 0;


        if (!$contact->save()) {
            $response = array(
                'status' => 'error',
                'model' => array("Contact" => $contact->getErrors())
            );

        } else {
            $response = array(
                'status' => 'success',
            );
        }

        echo CJSON::encode($response);

    }

    public function actionDeleteContact($id)
    {
        Contact::model()->deleteByPk($id);
        $response = array(
            'status' => 'success',
            'message' => 'Контакт удален',
        );
        echo CJSON::encode($response);
    }


    public function actionAbout()
    {
        Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
        $models = About::model()->findAll();

        if (empty($models)) {
            $about = new About();
        } else {
            $about = $models[0];
        }

        if (isset($_POST['About'])) {
            $about->attributes = $_POST['About'];
            $about->save();
            echo CJSON::encode(array(
                'status' => 'success'
            ));
            Yii::app()->end();
        }

        $page = Page::model()->findByAttributes(array('name' => Page::PAGE_ABOUT));

        $this->render('about', array('about' => $about, 'page' => $page));
    }

    public function actionSavePage($name)
    {
        $page = Page::model()->findByAttributes(array('name' => $name));
        MetaData::addSelf($page);
    }

}