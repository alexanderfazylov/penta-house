<?php

/**
 * This is the model class for table "{{maine}}".
 *
 * The followings are the available columns in table '{{maine}}':
 * @property integer $id
 * @property string $direction_1
 * @property string $direction_description_1
 * @property string $direction_2
 * @property string $direction_description_2
 * @property string $direction_3
 * @property string $direction_description_3
 * @property string $direction_4
 * @property string $direction_description_4
 * @property string $vk_link
 * @property string $fb_link
 * @property string $tw_link
 */
class Maine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{maine}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vk_link, fb_link, tw_link', 'length', 'max'=>255),
			array('direction_1, direction_description_1, direction_2, direction_description_2, direction_3, direction_description_3, direction_4, direction_description_4', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, direction_1, direction_description_1, direction_2, direction_description_2, direction_3, direction_description_3, direction_4, direction_description_4, vk_link, fb_link, tw_link', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'direction_1' => 'Direction 1',
			'direction_description_1' => 'Direction Description 1',
			'direction_2' => 'Direction 2',
			'direction_description_2' => 'Direction Description 2',
			'direction_3' => 'Direction 3',
			'direction_description_3' => 'Direction Description 3',
			'direction_4' => 'Direction 4',
			'direction_description_4' => 'Direction Description 4',
			'vk_link' => 'Vk Link',
			'fb_link' => 'Fb Link',
			'tw_link' => 'Tw Link',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('direction_1',$this->direction_1,true);
		$criteria->compare('direction_description_1',$this->direction_description_1,true);
		$criteria->compare('direction_2',$this->direction_2,true);
		$criteria->compare('direction_description_2',$this->direction_description_2,true);
		$criteria->compare('direction_3',$this->direction_3,true);
		$criteria->compare('direction_description_3',$this->direction_description_3,true);
		$criteria->compare('direction_4',$this->direction_4,true);
		$criteria->compare('direction_description_4',$this->direction_description_4,true);
		$criteria->compare('vk_link',$this->vk_link,true);
		$criteria->compare('fb_link',$this->fb_link,true);
		$criteria->compare('tw_link',$this->tw_link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Maine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
