<?php

class SiteController extends Controller
{
    public $cs;
    public $fb_link;
    public $vk_link;
    public $tw_link;
    public $main;
    public $description = '';
    public $keywords = '';
    public $contacts = array();
    public $active_contact_id = array();
    public $carousel_panel = false;
    public $entity_id = null;
    public $page_type = null;

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            // если используется проверка прав, не забывайте разрешить доступ к
            // действию, отвечающему за генерацию изображения
            array('allow',
                'actions' => array('captcha'),
                'users' => array('*'),
            ),
//            array('deny',
//                'users' => array('*'),
//            ),
        );
    }

    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
            ),
        );
    }

    public function init()
    {
        $this->cs = Yii::app()->clientScript;

        $this->cs->registerCoreScript('jquery');
        $this->cs->registerCssFile($this->createUrl('/css/style.css'));
        $this->cs->registerCssFile($this->createUrl('/dist/PageTransitions/css/animations.css'));
        $this->cs->registerScriptFile($this->createUrl('/js/app.js'));
        $this->cs->registerScriptFile($this->createUrl('/js/action.js'));
        $this->cs->registerScriptFile($this->createUrl('/dist/jquery.history.js'));
        $this->cs->registerScriptFile($this->createUrl('/dist/carousel.js'));
        //$this->cs->registerScriptFile($this->createUrl('/dist/jquery.lightbox-0.5.js'));
        $this->cs->registerScriptFile($this->createUrl('/dist/PageTransitions/js/modernizr.custom.js'));
        $this->cs->registerScriptFile($this->createUrl('/dist/PageTransitions/js/jquery.dlmenu.js'));

        $this->main = Maine::model()->findByPk(1);
        $this->contacts = Contact::mainFilter();

        Helper::selectCity($this->contacts);


        $this->active_contact_id = Yii::app()->session['contact_id'];
    }


    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */

    public function actionIndex()
    {
        $posts = Post::model()->findAll(Post::indexCriteria());
        $brands = Brand::model()->findAll(Brand::indexCriteria());
        $projects = Project::model()->findAll(Project::indexCriteria());
        $projects_count = Project::model()->count(Project::indexCountCriteria());
        $collections = Collection::model()->findAll(Collection::indexCriteria());

        $page = Page::model()->findByAttributes(array('name' => Page::PAGE_INDEX));
        $this->description = $page->meta_data->description;
        $this->keywords = $page->meta_data->keywords;
        $this->pageTitle = $page->meta_data->title;


        $this->render('index', array(
                'posts' => $posts,
                'brands' => $brands,
                'projects' => $projects,
                'projects_count' => $projects_count,
                'collections' => $collections,
            )
        );
    }

    public function actionAbout()
    {
        $posts = Post::model()->findAll(Post::indexCriteria());
        $about = About::model()->findByPk(1);
        $contacts = Contact::mainFilter(false);

        $page = Page::model()->findByAttributes(array('name' => Page::PAGE_ABOUT));
        $this->description = $page->meta_data->description;
        $this->keywords = $page->meta_data->keywords;
        $this->pageTitle = $page->meta_data->title;

        $this->render('about', array(
                'posts' => $posts,
                'about' => $about,
                'contacts' => $contacts,
            )
        );
    }


    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionContact()
    {
        $page = Page::model()->findByAttributes(array('name' => Page::PAGE_CONTACT));
        $this->description = $page->meta_data->description;
        $this->keywords = $page->meta_data->keywords;
        $this->pageTitle = $page->meta_data->title;

        $contacts = Contact::mainFilter(false);

        $this->render('contact', array('contacts' => $contacts));
    }

    public function actionCatalog()
    {
        $page = Page::model()->findByAttributes(array('name' => Page::PAGE_CATALOG));

        $this->description = $page->meta_data->description;
        $this->keywords = $page->meta_data->keywords;
        $this->pageTitle = $page->meta_data->title;


        $brands = Brand::model()->findAll(Brand::catalogCriteria());
        $this->render('catalog', array(
                'brands' => $brands,
            )
        );
    }


    public function actionLogin()
    {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->username = $_POST['LoginForm']['username'];
            $model->password = md5($_POST['LoginForm']['password']);
            $model->verifyCode = $_POST['LoginForm']['verifyCode'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect('/admin/');
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionCallback()
    {
        if (!isset($_POST['Callback'])) {
            echo CJSON::encode(array(
                'status' => 'error',
                'message' => 'Не корректный запрос',
            ));
            Yii::app()->end();
        }

        $callback = new Callback();
        $callback->attributes = $_POST['Callback'];

        if (!$callback->save()) {
            echo CJSON::encode(array(
                'status' => 'error',
                'model' => array("Callback" => $callback->getErrors())
            ));
            Yii::app()->end();
        }

        echo CJSON::encode(array(
            'status' => 'success',
        ));
    }

    public function actionDealership()
    {
        $this->render('dealership');
    }

    public function actionProjects()
    {
        $criteria = new CDbCriteria;
        $criteria->order = 't.end_date ASC, t.order ASC';
        $criteria->compare('t.visible', Project::VISIBLE);

        $projects = Project::model()->findAll($criteria);

        $years = array();
        foreach ($projects as $project) {
            $years[DateTime::createFromFormat('d.m.Y', $project->end_date)->setTimezone(new DateTimeZone('Europe/Moscow'))->format('Y')] = true;
        }
        asort($years);


        $page = Page::model()->findByAttributes(array('name' => Page::PAGE_PROJECTS));
        $this->description = $page->meta_data->description;
        $this->keywords = $page->meta_data->keywords;
        $this->pageTitle = $page->meta_data->title;

        $this->render('projects', array(
            'projects' => $projects,
            'years' => $years,
        ));
    }


    public function actionSelectCity($contact_id)
    {
        $contact = Contact::model()->findByPk($contact_id);

        Yii::app()->session['city'] = $contact->city;
        Yii::app()->session['contact_id'] = $contact->id;

        echo CJSON::encode(array(
            'status' => 'success',
        ));
    }


    public function actionPosts()
    {
        $page = Page::model()->findByAttributes(array('name' => Page::PAGE_POSTS));
        $this->description = $page->meta_data->description;
        $this->keywords = $page->meta_data->keywords;
        $this->pageTitle = $page->meta_data->title;

        $criteria = new CDbCriteria;
        $criteria->order = 't.start_date DESC';
        $criteria->compare('t.visible', Post::VISIBLE);

        $posts = Post::model()->findAll($criteria);

        $years = array();
        foreach ($posts as $post) {
            $years[DateTime::createFromFormat('d.m.Y', $post->start_date)->setTimezone(new DateTimeZone('Europe/Moscow'))->format('Y')] = true;
        }
        asort($years);


        $this->render('posts', array(
            'posts' => $posts,
            'years' => $years,
        ));
    }

    public function actionPost($id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.visible', Post::VISIBLE);
        $criteria->with = array(
            'post_upload',
            'post_upload.upload',
            'meta_data',
        );

        $post = Post::model()->findByPk($id, $criteria);

        if (empty($post)) {
            throw new CHttpException(404, 'Указанная запись не найдена');
        }
        $posts = Post::addPageEntitys($post->id);

        $this->description = $post->meta_data->description;
        $this->keywords = $post->meta_data->keywords;
        $this->pageTitle = $post->meta_data->title;

        $this->carousel_panel = true;
        $this->entity_id = $post->id;
        $this->page_type = Page::PAGE_POSTS;

        $this->render('post', array(
            'model' => $post,
            'models' => $posts,
        ));
    }

    public function actionProject($id)
    {
        $project = Project::model()->model()->findByPk($id, Project::selfPageCriteria());

        if (empty($project)) {
            throw new CHttpException(404, 'Указанная запись не найдена');
        }

        $projects = Project::model()->findAll(Project::pageProject($project->id));

        $this->description = $project->meta_data->description;
        $this->keywords = $project->meta_data->keywords;
        $this->pageTitle = $project->meta_data->title;

        $this->carousel_panel = true;
        $this->entity_id = $project->id;
        $this->page_type = Page::PAGE_PROJECTS;

        $this->render('project',
            array(
                'model' => $project,
                'models' => $projects,
            )
        );
    }

    public function actionCollection($id)
    {
        $collection = Collection::model()->model()->findByPk($id, Collection::selfPageCriteria());
        $brand = Brand::model()->find(Brand::pageCollection($collection->brand_id, $collection->id));


        if (empty($collection)) {
            throw new CHttpException(404, 'Указанная запись не найдена');
        }

        $this->description = $collection->meta_data->description;
        $this->keywords = $collection->meta_data->keywords;
        $this->pageTitle = $collection->meta_data->title;

        $this->carousel_panel = true;
        $this->entity_id = $collection->id;
        $this->page_type = Page::PAGE_COLLECTION;

        $this->render('collection',
            array(
                'model' => $collection,
                'models' => (isset($brand->collection) ? $brand->collection : array()),
            )
        );
    }

    public function actionBrand($id)
    {
        $brand = Brand::model()->find(Brand::pageBrand($id));

        if (empty($brand)) {
            throw new CHttpException(404, 'Указанная запись не найдена');
        }

        $this->carousel_panel = true;
        $this->entity_id = $brand->id;
        $this->page_type = Page::PAGE_BRAND;

        $this->description = $brand->meta_data->description;
        $this->keywords = $brand->meta_data->keywords;
        $this->pageTitle = $brand->meta_data->title;

        $this->render('brand', array(
                'model' => $brand
            )
        );
    }

    public function actionSearchModel($page_type, $entity_id, $location_type)
    {
        $page = Page::model()->findByAttributes(array('name' => $page_type));
        if (empty($page)) {
            throw new CHttpException(404, 'Неверный запрос');
        }
        $entity = Page::getEntity($page_type);
        $response = $entity::model()->SearchModel->condition($entity_id, $location_type);
        $this->pageTitle = $response['model']->meta_data->title;
        $html = $this->renderPartial($page->view, array(
            'model' => $response['model'],
            'models' => $response['models'],
            'page' => $page,
        ), true, false);

        echo $html;
    }
}