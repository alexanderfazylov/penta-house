<?php

/**
 * This is the model class for table "{{brand}}".
 *
 * The followings are the available columns in table '{{brand}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $site
 * @property string $sert
 * @property integer $meta_data_id
 * @property integer $upload_1_id
 * @property integer $upload_2_id
 * @property integer $upload_3_id
 * @property integer $upload_4_id
 * @property integer $maine_page_visible
 */
class Brand extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{brand}}';
    }

    public $collection_count;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('meta_data_id, upload_1_id, upload_2_id, upload_3_id, upload_4_id, maine_page_visible, order', 'numerical', 'integerOnly' => true, 'min' => 0),
            array('name, site, sert', 'length', 'max' => 255),
            array('description', 'safe'),

            array('id, name, maine_page_visible, collection_count', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'meta_data' => array(self::BELONGS_TO, 'MetaData', 'meta_data_id'),
            'upload1' => array(self::BELONGS_TO, 'Upload', 'upload_1_id'),
            'upload2' => array(self::BELONGS_TO, 'Upload', 'upload_2_id'),
            'upload3' => array(self::BELONGS_TO, 'Upload', 'upload_3_id'),
            'upload4' => array(self::BELONGS_TO, 'Upload', 'upload_4_id'),
            'collection' => array(self::HAS_MANY, 'Collection', 'brand_id'),
            'collectionCount' => array(self::STAT, 'Collection', 'brand_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Имя',
            'description' => 'Описание',
            'site' => 'Сайт',
            'sert' => 'Сертификат',
            'meta_data_id' => 'Meta Data',
            'upload_1_id' => 'Upload 1',
            'upload_2_id' => 'Upload 2',
            'upload_3_id' => 'Upload 3',
            'upload_4_id' => 'Upload 4',
            'maine_page_visible' => 'Видимость',
            'order' => 'Порядок вывода',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.order', $this->order);
        $criteria->compare('t.maine_page_visible', $this->maine_page_visible);

        $collection_table = Collection::model()->tableName();
        $post_count_sql = "(select count(*) from $collection_table pt where pt.brand_id = t.id)";

        // select
        $criteria->select = array(
            '*',
            $post_count_sql . " as collection_count",
        );


        // where
        $criteria->compare($post_count_sql, $this->collection_count);

        $criteria->with = array(
            'meta_data',
            'upload1',
            'upload2',
            'upload3',
            'upload4',
            'collection',
            'collectionCount',
        );

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.maine_page_visible ASC, t.order ASC',
                'attributes' => array(
                    'id',
                    'name',
                    'order',
                    'collection_count'

                )
            ),
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Brand the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function popupPrepear($model)
    {
        $item = Helper::convertModelToJson($model);
        return "<div data-item='$item' data-title='Редактирование {$model->name}' data-popup='edit-model' class='model-edit btn-popup'  >Редактировать</div>";
    }

    public function collectionCountCalck($model)
    {
        if (empty($model->collection)) {
            return 0;
        } else {
            return count($model->collection);
        }

    }

    public function pageVisible($model)
    {
        if ($model->maine_page_visible == 0) {
            return "Видимый";
        } else {
            return "Скрытый";
        }
    }

    public function getLogo($model)
    {
        $picter = '';
        $time = time();
        if (!empty($model->upload3)) {
            $picter = "<img src='/uploads/thumbs/{$model->upload3->file_name}?{$time}' />";
        }

        return $picter;

    }

    protected function beforeSave()
    {
        if (empty($this->order)) {
            $this->order = $this->id;
        }

        return parent::beforeSave();
    }

    public static function getVisibleSelect($model)
    {


        return CHtml::dropDownList(
            'Brand[maine_page_visible]', $model->maine_page_visible,
            CHtml::listData(
                array(
                    array(
                        'id' => '0',
                        'name' => 'Видимый',

                    ),
                    array(
                        'id' => '1',
                        'name' => 'Скрытый',

                    ),
                ),
                'id', 'name'),
            array('empty' => '-')

        );
    }

    public static function indexCriteria()
    {
        $criteria = new CDbCriteria;

        $criteria->order = 't.order ASC';
        $criteria->limit = 8;
        $criteria->compare('t.maine_page_visible', 0);

        $criteria->with = array(
            'upload1',
            'upload2',
        );

        return $criteria;
    }

    public static function catalogCriteria()
    {

        $criteria = new CDbCriteria;

        $criteria->order = 't.order ASC';
        //$criteria->limit = 8;
        $criteria->compare('t.maine_page_visible', 0);

        $criteria->with = array(
            //'upload1',
            'upload2',
            'collection',
            'collection.upload1',
        );

        return $criteria;
    }

    public static function pageCollection($brand_id, $collection_id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $brand_id);
        $criteria->with = array(
            'collection',
            'collection.upload1',
        );
        $criteria->addNotInCondition('collection.id', array($collection_id));

        return $criteria;
    }

    public static function pageBrand($id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $id);
        $criteria->limit = 8;
        $criteria->with = array(
            'collection' => array(
                'limit' => 3,
            ),
            'collection.upload1',
            'meta_data',
        );
        return $criteria;
    }

    public static function behaviorsCriteria()
    {
        $criteria = new CDbCriteria;

        if (isset($_GET['id']))
            $criteria->compare('t.id', $_GET['id']);

        $criteria->with = array(
            'collection' => array(//'limit' => 3,
            ),
            'collection.upload1',
            'meta_data',
        );
        return $criteria;
    }

    public static function collectionCountInput($model)
    {
        return "<input type='text' name='Brand[collection_count]' value='{$model->collection_count}'>";
    }


    public function behaviors()
    {
        return array(
            'SearchModel' => array(
                'class' => 'application.behaviors.SearchModel',
                'behaviorsCriteria' => self::behaviorsCriteria()
            ),
        );
    }
}
