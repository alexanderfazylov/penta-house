<?php

/**
 * This is the model class for table "{{project}}".
 *
 * The followings are the available columns in table '{{project}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $order
 * @property integer $visible
 * @property integer $upload_1_id
 * @property integer $meta_data_id
 */
class Project extends CActiveRecord
{
    const VIEW = 1;
    const BASE = 2;

    public $date_status = self::VIEW;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{project}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('order, visible, upload_1_id, meta_data_id', 'numerical', 'integerOnly' => true, 'min' => 0),
            array('name, end_date', 'length', 'max' => 255),
            array('description, end_date', 'safe'),
            array('id, name, order', 'safe', 'on' => 'search'),
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
            'project_upload' => array(self::HAS_MANY, 'ProjectUpload', 'project_id'),
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
            'end_date' => 'Дата окончания',
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
        $criteria->compare('t.end_date', self::formateDate($this->end_date));

        $criteria->with = array(
            'meta_data',
            'upload1',
            'project_upload',
            'project_upload.upload'
        );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.visible ASC, t.order ASC',
                'attributes' => array(
                    'id',
                    'name',
                    'order',
                    'end_date',
                )
            ),
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
    }

    public static function formateDate($date)
    {

        $resp = $date;
        if (!empty($date)) {
            $resp = DateTime::createFromFormat('d.m.Y', $date)->setTimezone(new DateTimeZone('Europe/Moscow'))->format('Y-m-d');
        }

        return $resp;

    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Project the static model class
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

    protected function afterFind()
    {
        if (!empty($this->end_date)) {
            $this->end_date = DateTime::createFromFormat('Y-m-d', $this->end_date)->setTimezone(new DateTimeZone('Europe/Moscow'))->format('d.m.Y');
        }

        return parent::afterFind();
    }

    protected function beforeSave()
    {

        if (!empty($this->end_date) && ($this->date_status == self::VIEW)) {
            $this->end_date = DateTime::createFromFormat('d.m.Y', $this->end_date)->setTimezone(new DateTimeZone('Europe/Moscow'))->format('Ymd');
            $this->date_status = self::BASE;
        }

        return parent::beforeSave();
    }

    public function getVisibleSelect($model)
    {

        return CHtml::dropDownList(
            'Project[visible]', $model->visible,
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
}
