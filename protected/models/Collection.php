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
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('order, maine_page_visible, tile, sanitary_engineering, upload_1_id, brand_id, meta_data_id', 'numerical', 'integerOnly' => true),
            array('name, slogan', 'length', 'max' => 255),
            array('description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, slogan, description, order, maine_page_visible, upload_1_id, brand_id, meta_data_id', 'safe', 'on' => 'search'),
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
            'collection_upload' => array(self::HAS_MANY, 'CollectionUpload', 'collection_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'slogan' => 'Slogan',
            'description' => 'Description',
            'order' => 'Order',
            'maine_page_visible' => 'Maine Page Visible',
            'upload_1_id' => 'Upload 1',
            'brand_id' => 'Brand',
            'meta_data_id' => 'Meta Data',
            'sanitary_engineering' => 'sanitary_engineering',
            'tile' => 'tile',
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
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('slogan', $this->slogan, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('order', $this->order);
        $criteria->compare('upload_1_id', $this->upload_1_id);
        $criteria->compare('brand_id', $this->brand_id);
        $criteria->compare('meta_data_id', $this->meta_data_id);

        $criteria->with = array('meta_data', 'upload1', 'collection_upload', 'collection_upload.upload');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.maine_page_visible ASC, t.order ASC',
                'attributes' => array(
                    't.id',
                    't.name',
                    't.order',
                    't.maine_page_visible',
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
}
