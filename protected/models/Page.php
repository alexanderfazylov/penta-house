<?php

/**
 * This is the model class for table "{{page}}".
 *
 * The followings are the available columns in table '{{page}}':
 * @property integer $id
 * @property string $name
 * @property integer $meta_data_id
 */
class Page extends CActiveRecord
{

    const PAGE_INDEX = 'index';
    const PAGE_ABOUT = 'about';
    const PAGE_CONTACT = 'contact';
    const PAGE_CATALOG = 'catalog';
    const PAGE_PROJECTS = 'projects';
    const PAGE_POSTS = 'posts';
    const PAGE_COLLECTION = 'collection';
    const PAGE_BRAND = 'brand';

    const MODEL_NEXT = 'next';
    const MODEL_PREV = 'prev';

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{page}}';
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
            array('meta_data_id', 'numerical', 'integerOnly' => true),
            array('name, entity', 'length', 'max' => 255),
            array('id, name, meta_data_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'meta_data' => array(self::BELONGS_TO, 'MetaData', 'meta_data_id'),
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
            'meta_data_id' => 'Meta Data',
            'entity' => 'entity',
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
        $criteria->compare('meta_data_id', $this->meta_data_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Page the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public static function getEntity($page_type)
    {
        $model = self::model()->findByAttributes(array('name' => $page_type));

        return $model->entity;

    }
}
