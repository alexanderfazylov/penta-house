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

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('meta_data_id, upload_1_id, upload_2_id, upload_3_id, upload_4_id, maine_page_visible', 'numerical', 'integerOnly' => true),
            array('name, site, sert', 'length', 'max' => 255),
            array('description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, description, site, sert, meta_data_id, upload_1_id, upload_2_id, upload_3_id, upload_4_id, maine_page_visible', 'safe', 'on' => 'search'),
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
            'description' => 'Description',
            'site' => 'Site',
            'sert' => 'Sert',
            'meta_data_id' => 'Meta Data',
            'upload_1_id' => 'Upload 1',
            'upload_2_id' => 'Upload 2',
            'upload_3_id' => 'Upload 3',
            'upload_4_id' => 'Upload 4',
            'maine_page_visible' => 'Maine Page Visible',
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

        $criteria->order = 't.id DESC';

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('site', $this->site, true);
        $criteria->compare('sert', $this->sert, true);
        $criteria->compare('meta_data_id', $this->meta_data_id);
        $criteria->compare('upload_1_id', $this->upload_1_id);
        $criteria->compare('upload_2_id', $this->upload_2_id);
        $criteria->compare('upload_3_id', $this->upload_3_id);
        $criteria->compare('upload_4_id', $this->upload_4_id);
        //$criteria->compare('maine_page_visible', $this->maine_page_visible);

        $criteria->with = array('meta_data', 'upload1', 'upload2', 'upload3', 'upload4',);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
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
        return "<div data-item='$item' data-title='Редактирование {$model->name}' data-popup='edit-brand' class='brand-edit btn-popup'  >Редактировать</div>";
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
        if (!empty($model->upload2)) {
            $picter = "<img src='/uploads/thumbs/{$model->upload2->file_name}?{$time}' />";
        }

        return $picter;

    }


}
