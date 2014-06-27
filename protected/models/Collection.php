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
            array('name, brand_id', 'required'),
            array('order, maine_page_visible, tile, sanitary_engineering, index_slider, upload_1_id, upload_2_id, brand_id, meta_data_id, entity_id', 'numerical', 'integerOnly' => true, 'min' => 0),
            array('name, slogan', 'length', 'max' => 255),
            array('description', 'safe'),
            array('id, name, order, brand_id, maine_page_visible', 'safe', 'on' => 'search'),
            array('name', 'UniqueAttributesValidator', 'with' => 'brand_id'),
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
            'brand_id' => 'Производитель',
            'meta_data_id' => 'Meta Data',
            'sanitary_engineering' => 'sanitary_engineering',
            'tile' => 'Заголовок',
            'brand.name' => 'Производитель',
            'index_slider' => 'Выведена&nbsp;на главную&nbsp;страницу',
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
        $criteria->compare('t.index_slider', $this->index_slider);

        //$criteria->compare('brand.maine_page_visible', Brand::VISIBLE);

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
                'defaultOrder' => 'brand.name ASC, t.order ASC, t.name ASC',
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

        $criteria->order = 't.name ASC';


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
        $criteria->compare('brand.maine_page_visible', Brand::VISIBLE);

        $criteria->with = array(
            'upload2',
            'brand'
        );

        return $criteria;
    }

    public static function selfPageCriteria($id)
    {
        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $id);
        $criteria->compare('t.maine_page_visible', Collection::VISIBLE);
        $criteria->compare('brand.maine_page_visible', Brand::VISIBLE);


        $criteria->with = array(
            'collection_upload',
            'meta_data',
            'entity',
            'brand',
        );
        return $criteria;
    }

    public static function getIndexSliderSelect($model)
    {
        return CHtml::dropDownList(
            'Collection[index_slider]', $model->index_slider,
            CHtml::listData(
                array(
                    array(
                        'id' => '0',
                        'name' => 'нет',

                    ),
                    array(
                        'id' => '1',
                        'name' => 'да',

                    ),
                ),
                'id', 'name'),
            array('empty' => '-')

        );
    }

    public static function indexSlider($model)
    {
        if ($model->index_slider == self::INDEX_SLIDER_TRUE) {
            return 'Да';
        } else {
            return 'Нет';
        }
    }

    public static function getIncrementLastOrder($brand_id)
    {
        $criteria = new CDbCriteria;
        $criteria->limit = 1;
        $criteria->order = 't.order DESC';
        $criteria->compare('t.brand_id', $brand_id);


        $model = self::model()->find($criteria);


        if (empty($model->order)) {
            return 1;
        } else {
            return ++$model->order;
        }

    }

    protected function beforeSave()
    {
        if ($this->isNewRecord || empty($this->order)) {
            $this->order = self::getIncrementLastOrder($this->brand_id);
        }

        return parent::beforeSave();
    }

    public static function behaviorsCriteria($brand_id, $in_brand)
    {
        $criteria = new CDbCriteria;


        $criteria->order = 'brand.name ASC, t.order ASC';
        //$criteria->limit = 9;

        $criteria->compare('t.maine_page_visible', self::VISIBLE);

        $criteria->with = array(
            'upload1',
        );

        if ($in_brand) {
            array_push($criteria->with, 'brand');
            $criteria->order = 'brand.order ASC, t.order ASC';
            $criteria->compare('brand.maine_page_visible', Brand::VISIBLE);
            $criteria->compare('t.maine_page_visible', self::VISIBLE);
        } else {
            $criteria->with = array(
                'upload1',
            );
        }


        return $criteria;
    }

    public function searchCollection($entity_id, $location_type)
    {
        $entity = null;
        $current_index = null;
        $last_index = null;
        $search_index = null;

        $current_model = self::model()->find(Collection::selfPageCriteria($entity_id));

        if (empty($current_model)) {
            throw new CHttpException(404, 'Нет записей для отображения');
        }


        $models = self::model()->findAll(self::behaviorsCriteria($current_model->brand_id, true));


        if (empty($models)) {
            throw new CHttpException(404, 'Нет записей для отображения');
        }


        foreach ($models as $key => $model) {
            if ($model->id == $entity_id) {
                $current_index = $key;
            }
            $last_index = $key;
        }
        //

        if ($location_type == Page::MODEL_NEXT) {
            if ($current_index == $last_index) {
                $current_index = 0;

            } else {
                ++$current_index;
            }
        } else if ($location_type == Page::MODEL_PREV) {
            if ($current_index == 0) {
                $current_index = $last_index;
            } else {
                --$current_index;
            }
        } else {
            throw new CHttpException(404, 'Неверный запрос');
        }

        $current_model = $models[$current_index];


        foreach ($models as $ind => $val) {
            //if ($val->brand_id != $current_model->brand_id && count($models) > 5) {
            if ($val->brand_id != $current_model->brand_id) {
                unset($models[$ind]);
            }
        }

        unset($models[$current_index]);
        //array_splice($models, $current_index, 1);

        $response = array(
            'model' => $current_model,
            'models' => $models
        );

        return $response;
    }
}
