<?php

/**
 * This is the model class for table "{{contact}}".
 *
 * The followings are the available columns in table '{{contact}}':
 * @property integer $id
 * @property string $city
 * @property string $phone
 * @property string $address
 * @property string $map
 * @property integer $order
 * @property integer $type
 * @property integer $visible
 * @property integer default_in_city
 * @property string $monday_start
 * @property string $monday_end
 * @property string $tuesday_start
 * @property string $tuesday_end
 * @property string $wednesday_start
 * @property string $wednesday_end
 * @property string $thursday_start
 * @property string $thursday_end
 * @property string $friday_start
 * @property string $friday_end
 * @property string $saturday_start
 * @property string $saturday_end
 * @property string $sunday_start
 * @property string $sunday_end
 */
class Contact extends CActiveRecord
{
    const VISIBLE = 0;
    const HIDDEN = 1;
    const DEFAULT_FALSE = 0;
    const DEFAULT_TRUE = 1;
    const DEFAULT_IN_CITY_FALSE = 0;
    const DEFAULT_IN_CITY_TRUE = 1;


    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{contact}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('city', 'required'),
            array('order, type, visible, default, default_in_city, zoom', 'numerical', 'integerOnly' => true, 'min' => 0),
            array('longitude, latitude, city, phone, address, weekdays, saturday, sunday', 'length', 'max' => 255),
            array('map', 'safe'),
            array('id, city, phone, address, map, order, type, visible', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'city' => 'Город',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'zoom' => 'Зум',
            'latitude' => 'Широта',
            'longitude' => 'Долгота',
            'order' => 'Порядок вывода',
            'type' => 'Тип',
            'visible' => 'Видимость',
            'default' => 'Город по умолчанию',
            'default_in_city' => 'Контакт по умолчанию среди одинаковых городов',

            'weekdays' => 'weekdays',
            'saturday' => 'saturday',
            'sunday' => 'sunday',


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
        $criteria->compare('t.city', $this->city, true);
        $criteria->compare('t.order', $this->order);
        $criteria->compare('t.phone', $this->phone);
        $criteria->compare('t.visible', $this->visible);
        $criteria->compare('t.type', $this->type);

//        $criteria->with = array(
//            'meta_data',
//        );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.visible ASC, t.order ASC',
                'attributes' => array(
                    'id',
                    'city',
                    'order',
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
     * @return Contact the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function popupPrepear($model)
    {
        $item = Helper::convertModelToJson($model);
        return "<div data-item='$item' data-title='Редактирование {$model->city}' data-popup='edit-model' class='model-edit btn-popup'  >Редактировать</div>";
    }

    public static function getVisibleSelect($model)
    {

        return CHtml::dropDownList(
            'Contact[visible]', $model->visible,
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
        if ($model->visible == self::VISIBLE) {
            return "Видимый";
        } else {
            return "Скрытый";
        }
    }

    public static function getTypeSelect($model)
    {
        return CHtml::dropDownList('Contact[type]', $model->type, CHtml::listData(self::typeArray(), 'id', 'name'), array('empty' => '-'));
    }

    public static function typeArray()
    {
        return
            array(
                array(
                    'id' => '1',
                    'name' => 'Проектный офис',

                ),
                array(
                    'id' => '2',
                    'name' => 'Шоурум',

                ),
            );
    }

    public static function getType($model)
    {
        if (isset($model->type)) {
            if ($model->type == 1) {
                return "Проектный офис";
            } elseif ($model->type == 2) {
                return "Шоурум";
            }
        }else{
            return 'Не выбран';
        }
    }

    public function defaultInCity($contact)
    {
        if ($this->default_in_city == self::DEFAULT_IN_CITY_FALSE) {
            if (empty($contact)) {
                $this->addError('default_in_city', "В городе {$this->city}, нет ни одного контакта по умолчанию.");
            }
        } else {
            if (!$this->isNewRecord) {
                if (!empty($contact)) {
                    if ($contact->id != $this->id) {
                        $this->addError('default_in_city', "В {$this->city} уже есть город по умолчанию");
                    }
                }
            }
        }
    }


    protected function beforeValidate()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.visible', self::VISIBLE);
        $criteria->compare('t.city', $this->city);
        $criteria->compare('t.default_in_city', self::DEFAULT_IN_CITY_TRUE);
        $contact = self::model()->find($criteria);


        $this->defaultInCity($contact);


        return parent::beforeValidate();
    }

    protected function beforeSave()
    {
        return parent::beforeSave();
    }

    public static function strtolower($text)
    {
        return mb_strtolower($text, 'UTF-8');
    }

    public static function mainFilter($group = true)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.visible', self::VISIBLE);
        $criteria->order = 't.city ASC';

        if ($group) {
            $criteria->group = 't.city';
            $criteria->compare('t.default_in_city', self::DEFAULT_IN_CITY_TRUE);
        }

        return Contact::model()->findAll($criteria);
    }


}
