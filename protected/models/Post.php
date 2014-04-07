<?php

/**
 * This is the model class for table "{{post}}".
 *
 * The followings are the available columns in table '{{post}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $order
 * @property integer $visible
 * @property integer $upload_1_id
 * @property integer $meta_data_id
 * @property string $start_date
 */
class Post extends CActiveRecord
{
    const VIEW = 1;
    const BASE = 2;

    public $date_status = self::VIEW;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{post}}';
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
            array('order, visible, upload_1_id, meta_data_id', 'numerical', 'integerOnly' => true, 'min' => 0),
            array('name', 'length', 'max' => 255),
            array('description, start_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, description, order, visible, upload_1_id, meta_data_id, start_date', 'safe', 'on' => 'search'),
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
            'post_upload' => array(self::HAS_MANY, 'PostUpload', 'post_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Заголовок',
            'description' => 'Текст',
            'order' => 'Сортировка',
            'visible' => 'Видимость',
            'upload_1_id' => 'Upload 1',
            'meta_data_id' => 'Meta Data',
            'start_date' => 'Дата',
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

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.order', $this->order);
        $criteria->compare('t.visible', $this->visible);
        $criteria->compare('t.start_date', self::formateDate($this->start_date));

        $criteria->with = array(
            'meta_data',
            'upload1',
            'post_upload',
            'post_upload.upload'
        );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.visible ASC, t.order ASC',
                'attributes' => array(
                    't.id',
                    't.name',
                    't.order',
                    't.visible',
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
     * @return Post the static model class
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

    public function getVisibleSelect($model)
    {

        return CHtml::dropDownList(
            'Post[visible]', $model->visible,
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

    public function pageVisible($model)
    {
        if ($model->visible == 0) {
            return "Видимый";
        } else {
            return "Скрытый";
        }
    }

    protected function afterFind()
    {
        if (!empty($this->start_date)) {
            $this->start_date = DateTime::createFromFormat('Y-m-d', $this->start_date)->setTimezone(new DateTimeZone('Europe/Moscow'))->format('d.m.Y');
        }

        return parent::afterFind();
    }

    protected function beforeSave()
    {

        if (!empty($this->start_date) && ($this->date_status == self::VIEW)) {
            $this->start_date = DateTime::createFromFormat('d.m.Y', $this->start_date)->setTimezone(new DateTimeZone('Europe/Moscow'))->format('Ymd');
            $this->date_status = self::BASE;
        }

        return parent::beforeSave();
    }

    public static function formateDate($date)
    {

        $resp = $date;
        if (!empty($date)) {
            $resp = DateTime::createFromFormat('d.m.Y', $date)->setTimezone(new DateTimeZone('Europe/Moscow'))->format('Y-m-d');
        }

        return $resp;

    }
}
