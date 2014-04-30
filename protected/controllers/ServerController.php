<?php

class ServerController extends Controller
{
    private $base_path = 'uploads/';
    private $thumbs_path = 'thumbs/';
    private $medium_path = 'medium/';
    private $allowed_extensions = array("jpeg", "jpg", "png", "gif");

    private function getSizeLimit()
    {
        return 10 * 1024 * 1024;
    }

    public function init()
    {
        if (!is_dir($this->base_path)) {
            mkdir($this->base_path);
            chmod($this->base_path, 0777);
        }

        if (!is_dir($this->base_path . $this->thumbs_path)) {
            mkdir($this->base_path . $this->thumbs_path);
            chmod($this->base_path . $this->thumbs_path, 0777);
        }

        if (!is_dir($this->base_path . $this->medium_path)) {
            mkdir($this->base_path . $this->medium_path);
            chmod($this->base_path . $this->medium_path, 0777);
        }
    }

    public function upload($model, $attribute)
    {
        $uploader = new qqFileUploader($this->allowed_extensions, $this->getSizeLimit());
        $result = $uploader->handleUpload($this->base_path, FALSE, $model, $attribute);
        $this->createTumbs($result['file_name']);
        $this->createMedium($result['file_name']);
        return $result;
    }

    public function createTumbs($filename)
    {
        Yii::app()->ih
            ->load($this->base_path . $filename)
            ->resize(80, 60)
            ->save($this->base_path . $this->thumbs_path . $filename);
        return true;
    }

    public function createMedium($filename)
    {
        $width = 900;
        $height = 900;

        $picter = Yii::app()->ih->load($this->base_path . $filename);

        if ($picter->getWidth() > $width || $picter->getHeight() > $height) {
            $picter->resize($width, $height);
        }

        $picter->save($this->base_path . $this->medium_path . $filename);

        return true;
    }

    public function actionInfoFile($upload_id)
    {
        echo Helper::convertModelToJson(Upload::model()->findByPk($upload_id));
    }

    public function actionDeleteFile($upload_id)
    {
        $upload = Upload::model()->findByPk($upload_id);

        $model_name = $upload->model;
        $atr = $upload->attribute;

        $model = $model_name::model()->findByAttributes(array("$atr" => $upload->id));

        if (!empty($model)) {
            $model->$atr = null;
            $model->save(false);
        }

        $upload->delete();

        echo CJSON::encode(array('status' => 'success'));
    }

    public function actionCrop()
    {
        $upload = Upload::model()->findByPk($_POST['Upload']['id']);

        if (($_POST['w'] != '') && ($_POST['h'] != '') && ($_POST['x1'] != '') && ($_POST['y1']) != '') {
            $this->cropOrig($upload->file_name);
            $this->cropMedium($upload->file_name);
            $this->cropThumbs($upload->file_name);

        }


        echo CJSON::encode(array('status' => 'success', 'model' => Helper::convertModelToArray($upload)));
    }

    public function cropMedium($file_name)
    {
        $picter = $this->base_path . $this->medium_path . $file_name;


        Yii::app()->ih
            ->load($picter)
            ->crop($_POST['w'], $_POST['h'], $_POST['x1'], $_POST['y1'])
            ->save($picter);


        return true;
    }

    public function cropThumbs($file_name)
    {
        $picter = $this->base_path . $this->medium_path . $file_name;

        unlink($this->base_path . $this->thumbs_path . $file_name);

        Yii::app()->ih
            ->load($picter)
            ->resize(80, 60)
            ->save($this->base_path . $this->thumbs_path . $file_name);

        return true;
    }

    public function cropOrig($file_name)
    {
        $picter = Yii::app()->ih->load($this->base_path . $file_name);
        $medium_picter = Yii::app()->ih->load($this->base_path . $this->medium_path . $file_name);

        unlink($this->base_path . $file_name);

        $f = $picter->getWidth() / $medium_picter->getWidth();

        $picter
            ->crop($_POST['w'] * $f, $_POST['h'] * $f, $_POST['x1'] * $f, $_POST['y1'] * $f)
            ->save($this->base_path . $file_name);

        return true;
    }

    /*
     * Brand uploads
     * */
    public function actionUploadBrand1()
    {
        $result = $this->upload('Brand', 'upload_1_id');

        Yii::app()->ih
            ->load($this->base_path . $result['file_name'])
            ->resize(400, 200)
            ->save($this->base_path . $result['file_name']);


        echo CJSON::encode($result);
    }

    public function actionUploadBrand2()
    {
        $result = $this->upload('Brand', 'upload_2_id');

        Yii::app()->ih
            ->load($this->base_path . $result['file_name'])
            ->resize(180, 200)
            ->save($this->base_path . $result['file_name']);

        echo CJSON::encode($result);
    }

    public function actionUploadBrand3()
    {
        $result = $this->upload('Brand', 'upload_3_id');

        Yii::app()->ih
            ->load($this->base_path . $result['file_name'])
            ->resize(180, 200)
            ->save($this->base_path . $result['file_name']);

        echo CJSON::encode($result);
    }

    public function actionUploadBrand4()
    {
        $result = $this->upload('Brand', 'upload_4_id');
        echo CJSON::encode($result);
    }

    public function actionCollectionUplod1()
    {
        $result = $this->upload('Collection', 'upload_1_id');
        Yii::app()->ih
            ->load($this->base_path . $result['file_name'])
            ->resize(400, 200)
            ->save($this->base_path . $result['file_name']);

        echo CJSON::encode($result);
    }

    public function actionCollectionUplod2()
    {
        $result = $this->upload('Collection', 'upload_2_id');
        Yii::app()->ih
            ->load($this->base_path . $result['file_name'])
            ->resize(1200, 600)
            ->save($this->base_path . $result['file_name']);

        echo CJSON::encode($result);
    }

    public function actionCollectionUpload()
    {
        $result = $this->upload('CollectionUpload', 'upload_id');

        Yii::app()->ih
            ->load($this->base_path . $result['file_name'])
            ->resize(2000, 800)
            ->save($this->base_path . $result['file_name']);

        echo CJSON::encode($result);
    }

    public function actionProjectUpload()
    {
        $result = $this->upload('ProjectUpload', 'upload_id');
        echo CJSON::encode($result);
    }


    public function actionProjectUplod1()
    {
        $result = $this->upload('Project', 'upload_1_id');
        echo CJSON::encode($result);
    }

    public function actionPostUplod1()
    {
        $result = $this->upload('Post', 'upload_1_id');
        echo CJSON::encode($result);
    }

    public function actionPostUpload()
    {
        $result = $this->upload('PostUpload', 'upload_id');
        echo CJSON::encode($result);
    }

}