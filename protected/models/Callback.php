<?php

/**
 * This is the model class for table "{{callback}}".
 *
 * The followings are the available columns in table '{{callback}}':
 * @property integer $id
 * @property string $text
 * @property string $name
 * @property string $phone
 * @property string $created
 */
class Callback extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{callback}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('phone, created', 'required'),
            array('name, phone', 'length', 'max' => 255),
            array('text', 'safe'),
            array('id, text, name, phone, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'text' => 'Тема звонка',
            'name' => 'Как Вас зовут',
            'phone' => 'Контактный телефон',
            'created' => 'Created',
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
        $criteria->compare('text', $this->text, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('created', $this->created, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Callback the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    protected function beforeValidate()
    {
        $this->created = date('Y-m-d H:i:s');
        return parent::beforeValidate();
    }


    protected function sendMailManagers()
    {
        $managers = array(
            'alexander@fazylov.ru',
            'lkdnvc@gmail.com',
            'lkdnvc@yandex.ru',
            'santika-online@yandex.ru',
        );

        $params = array();

        foreach ($managers as $manager_mail) {
            $params = array();
            $params['recipient'] = $manager_mail;
            $params['subject'] = 'Заказан обратный звонок на сайте penta-house.ru';
            $params['from_name'] = 'penta-house.ru';
            $params['model'] = $this;

            Helper::sendMail('callback_manager', $params);
        }


    }

    protected function sendMailAuthor($author_mail)
    {
        $params = array();
        $params['recipient'] = $author_mail;
        $params['subject'] = 'Спасибо за обращение';
        $params['from_name'] = 'менеджер Александр';
        $params['model'] = $this;

        Helper::sendMail('callback', $params);
    }

    protected function afterSave()
    {


        $this->sendMailManagers();

        //$this->sendMailAuthor();


        return parent::afterSave();
    }

}
