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
            array('order, type, visible, default', 'numerical', 'integerOnly' => true, 'min' => 0),
            array('city, phone, address, monday_start, monday_end, tuesday_start, tuesday_end, wednesday_start, wednesday_end, thursday_start, thursday_end, friday_start, friday_end, saturday_start, saturday_end, sunday_start, sunday_end', 'length', 'max' => 255),
            array('map', 'safe'),
            array('id, city, phone, address, map, order, type, visible, monday_start, monday_end, tuesday_start, tuesday_end, wednesday_start, wednesday_end, thursday_start, thursday_end, friday_start, friday_end, saturday_start, saturday_end, sunday_start, sunday_end', 'safe', 'on' => 'search'),
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
            'map' => 'Карта',
            'order' => 'Порядок вывода',
            'type' => 'Тип',
            'visible' => 'Видимость',
            'default' => 'Город по умолчанию',

            'monday_start' => 'Monday Start',
            'monday_end' => 'Monday End',

            'tuesday_start' => 'Tuesday Start',
            'tuesday_end' => 'Tuesday End',

            'wednesday_start' => 'Wednesday Start',
            'wednesday_end' => 'Wednesday End',

            'thursday_start' => 'Thursday Start',
            'thursday_end' => 'Thursday End',

            'friday_start' => 'Friday Start',
            'friday_end' => 'Friday End',

            'saturday_start' => 'Saturday Start',
            'saturday_end' => 'Saturday End',

            'sunday_start' => 'Sunday Start',
            'sunday_end' => 'Sunday End',
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
        return CHtml::dropDownList(
            'Contact[type]', $model->type,
            CHtml::listData(
                array(
                    array(
                        'id' => '1',
                        'name' => 'магазин',

                    ),
                    array(
                        'id' => '2',
                        'name' => 'склад',

                    ),
                    array(
                        'id' => '3',
                        'name' => 'шоурум',

                    ),
                ),
                'id', 'name'),
            array('empty' => '-')

        );
    }

    public function getType($model)
    {
        if ($model->type == 1) {
            return "магазин";
        } elseif ($model->type == 2) {
            return "склад";
        } elseif ($model->type == 3) {
            return "шоурум";
        }
    }


}
