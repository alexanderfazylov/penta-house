<?php

/**
 * This is the model class for table "{{meta_data}}".
 *
 * The followings are the available columns in table '{{meta_data}}':
 * @property integer $id
 * @property string $description
 * @property string $keywords
 */
class MetaData extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{meta_data}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('description, keywords', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, description, keywords', 'safe', 'on' => 'search'),
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
            'description' => 'Description',
            'keywords' => 'Keywords',
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
        $criteria->compare('description', $this->description, true);
        $criteria->compare('keywords', $this->keywords, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MetaData the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function addSelf($model)
    {
        if (isset($_POST['MetaData'])) {
            $response = array(
                'status' => 'success'
            );

            if (!empty($model->meta_data_id)) {
                $meta_data = self::model()->findByPk($model->meta_data_id);
            } else {
                $meta_data = new self();
            }

            $meta_data->attributes = $_POST['MetaData'];

            if (!$meta_data->save()) {
                $response = array(
                    'status' => 'success',
                    'model' => array("MetaData" => $meta_data->getErrors())
                );
                Yii::app()->end();
            }


            $model->meta_data_id = $meta_data->id;
            $model->save();

            echo CJSON::encode($response);

        }
    }

}
