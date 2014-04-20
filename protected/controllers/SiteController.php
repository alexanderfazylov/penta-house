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

    public function init()
    {
        $this->cs = Yii::app()->clientScript;

        $this->cs->registerCoreScript('jquery');
        $this->cs->registerCssFile($this->createUrl('/css/style.css'));
        $this->cs->registerScriptFile($this->createUrl('/js/app.js'));
        $this->cs->registerScriptFile($this->createUrl('/js/action.js'));


        $this->main = Maine::model()->findByPk(1);
        $this->contacts = Contact::mainFilter();

        Helper::selectCity($this->contacts);


        $this->active_contact_id = Yii::app()->session['contact_id'];
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->cs->registerScriptFile($this->createUrl('/dist/mobilyslider.js'));

        $posts = Post::model()->findAll(Post::indexCriteria());
        $brands = Brand::model()->findAll(Brand::indexCriteria());
        $projects = Project::model()->findAll(Project::indexCriteria());
        $projects_count = Project::model()->count(Project::indexCountCriteria());
        $collections = Collection::model()->findAll(Collection::indexCriteria());


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
        $this->pageTitle = "Penta House - Контакты";
        $contacts = Contact::mainFilter(false);
        $this->render('contact', array('contacts' => $contacts));
    }

    public function actionCatalog()
    {
        $this->pageTitle = "Penta House - Элитная сантехника и плитка. Продажа. Монтаж. Сервис.";


        $brands = Brand::model()->findAll(Brand::catalogCriteria());

        $this->render('catalog', array(
                'brands' => $brands,
            )
        );
    }

    public function actionBrand($id)
    {
        $this->cs->registerScriptFile($this->createUrl('/dist/mobilyslider.js'));

        $brand = Brand::model()->findByPk($id);


        $this->render('brand', array(
                'brand' => $brand
            )
        );
    }


    public function actionCollection($id)
    {
        $this->cs->registerScriptFile($this->createUrl('/dist/mobilyslider.js'));
        $this->cs->registerScriptFile($this->createUrl('/dist/jquery.lightbox-0.5.js'));


        $collection = Collection::model()->model()->findByPk($id, Collection::selfPageCriteria());
        $brand = Brand::model()->find(Brand::pageCollection($collection->brand_id));

        if (empty($collection)) {
            throw new CHttpException(404, 'Указанная запись не найдена');
        }

        $this->render('collection',
            array(
                'collection' => $collection,
                'brand' => $brand,
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
        $criteria->order = 't.order ASC, t.end_date ASC';
        $criteria->compare('t.visible', Project::VISIBLE);

        $projects = Project::model()->findAll($criteria);

        $years = array();
        foreach ($projects as $project) {
            $years[DateTime::createFromFormat('d.m.Y', $project->end_date)->setTimezone(new DateTimeZone('Europe/Moscow'))->format('Y')] = true;
        }
        ksort($years);


        $this->render('projects', array(
            'projects' => $projects,
            'years' => $years,
        ));
    }

    public function actionProject($id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.visible', Project::VISIBLE);
        $project = Project::model()->findAllByPk($id, $criteria);

        if (empty($project)) {
            throw new CHttpException(404, 'Указанная запись не найдена');
        }

        $this->render('project', array(
            'project' => $project
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
        $criteria = new CDbCriteria;
        $criteria->order = 't.order ASC, t.start_date ASC';
        $criteria->compare('t.visible', Post::VISIBLE);

        $posts = Post::model()->findAll($criteria);

        $years = array();
        foreach ($posts as $post) {
            $years[DateTime::createFromFormat('d.m.Y', $post->start_date)->setTimezone(new DateTimeZone('Europe/Moscow'))->format('Y')] = true;
        }
        ksort($years);


        $this->render('posts', array(
            'posts' => $posts,
            'years' => $years,
        ));
    }

    public function actionPost($id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.visible', Project::VISIBLE);
        $project = Project::model()->findAllByPk($id, $criteria);

        if (empty($project)) {
            throw new CHttpException(404, 'Указанная запись не найдена');
        }

        $this->render('project', array(
            'project' => $project
        ));
    }


}