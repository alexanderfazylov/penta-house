<?php

/**
 * This is the model class for table "{{collection}}".
 *
 * The followings are the available columns in table '{{collection}}':
 * @property integer $id
 * @property string $name
 * @property string $slogan
 * @property string $description
 * @property integer $order
 * @property integer $maine_page_visible
 * @property integer $upload_1_id
 * @property integer $brand_id
 * @property integer $meta_data_id
 */
class Collection extends CActiveRecord
{
    const VISIBLE = 0;
    const HIDDEN = 1;
    const INDEX_SLIDER_FALSE = 0;
    const INDEX_SLIDER_TRUE = 1;


    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{collection}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('order, maine_page_visible, tile, sanitary_engineering, index_slider, upload_1_id, upload_2_id, brand_id, meta_data_id, entity_id', 'numerical', 'integerOnly' => true, 'min' => 0),
            array('name, slogan', 'length', 'max' => 255),
            array('description', 'safe'),
            array('id, name, order, brand_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'meta_data' => array(self::BELONGS_TO, 'MetaData', 'meta_data_id'),
            'upload1' => array(self::BELONGS_TO, 'Upload', 'upload_1_id'),
            'upload2' => array(self::BELONGS_TO, 'Upload', 'upload_2_id'),
            'brand' => array(self::BELONGS_TO, 'Brand', 'brand_id'),
            'collection_upload' => array(self::HAS_MANY, 'CollectionUpload', 'collection_id'),
            'entity' => array(self::BELONGS_TO, 'Entity', 'entity_id'),
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
            'slogan' => 'Слоган',
            'description' => 'Текст',
            'order' => 'Сортировка',
            'maine_page_visible' => 'Видимость',
            'upload_1_id' => 'Upload 1',
            'upload_2_id' => 'Upload 2',
            'brand_id' => 'Brand',
            'meta_data_id' => 'Meta Data',
            'sanitary_engineering' => 'sanitary_engineering',
            'tile' => 'Заголовок',
            'brand.name' => 'Производитель',
            'index_slider' => 'index_slider',
            'entity_id' => 'entity_id',
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
        $criteria->compare('t.brand_id', $this->brand_id);
        $criteria->compare('t.maine_page_visible', $this->maine_page_visible);

        $criteria->with = array(
            'meta_data',
            'upload1',
            'upload2',
            'brand',
            'collection_upload',
            'collection_upload.upload'
        );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.maine_page_visible ASC, t.order ASC, t.name ASC',
                'attributes' => array(
                    'id' => 'id',
                    'name' => 'name',
                    'order' => 'order',
                    //'brand.name' => 'brand.name',
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
     * @return Collection the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function pageVisible($model)
    {
        if ($model->maine_page_visible == 0) {
            return "Видимый";
        } else {
            return "Скрытый";
        }
    }

    public function popupPrepear($model)
    {
        $item = Helper::convertModelToJson($model);
        return "<div data-item='$item' data-title='Редактирование {$model->name}' data-popup='edit-model' class='model-edit btn-popup'  >Редактировать</div>";
    }

    public static function getBrandSelect($collection)
    {
        $criteria = new CDbCriteria;

        $criteria->order = 't.maine_page_visible ASC, t.order ASC';


        return CHtml::dropDownList(
            'Collection[brand_id]', $collection->brand_id,
            CHtml::listData(Brand::model()->findAll($criteria), 'id', 'name'),
            array('empty' => '-')

        );
    }

    public static function getVisibleSelect($model)
    {

        return CHtml::dropDownList(
            'Collection[maine_page_visible]', $model->maine_page_visible,
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


    public function getBrandLogo($model)
    {


        $picter = '';
        $time = time();
        if (!empty($model->brand->upload3)) {
            $picter = "<img src='/uploads/thumbs/{$model->brand->upload3->file_name}?{$time}' />";
        }

        return $picter;

    }

    public static function indexCriteria()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.maine_page_visible', self::VISIBLE);
        $criteria->compare('t.index_slider', self::INDEX_SLIDER_TRUE);
        $criteria->with = array(
            'upload2'
        );

        return $criteria;
    }

    public static function selfPageCriteria()
    {
        $criteria = new CDbCriteria;
        $criteria->order = 't.order ASC';
        $criteria->compare('t.maine_page_visible', Collection::VISIBLE);

        $criteria->with = array(
            'collection_upload',
            'meta_data',
            'entity',
        );
        return $criteria;
    }
}
