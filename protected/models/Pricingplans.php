<?php

/**
 * This is the model class for table "dt_pricing_plans".
 *
 * The followings are the available columns in table 'dt_pricing_plans':
 * @property integer $id
 * @property string $name
 * @property double $cost
 * @property integer $validity
 * @property string $validity_type
 * @property integer $stylists
 * @property string $status
 */
class Pricingplans extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pricingplans the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dt_pricing_plans';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, cost, validity, validity_type, stylists','required'),
			array('validity, stylists', 'numerical', 'integerOnly'=>true),
			array('cost', 'numerical'),
			array('name', 'length', 'max'=>255),
			array('validity_type', 'length', 'max'=>5),
			array('status', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
                    
			array('id, name, cost, validity, validity_type, stylists, status', 'safe', 'on'=>'search'),
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
			'planuser' => array(self::HAS_MANY, 'Pricingplansusers', 'evolution_id'),
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
			'cost' => 'Cost',
			'validity' => 'Validity',
			'validity_type' => 'Validity Type',
			'stylists' => 'Stylists',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('cost',$this->cost);
		$criteria->compare('validity',$this->validity);
		$criteria->compare('validity_type',$this->validity_type,true);
		$criteria->compare('stylists',$this->stylists);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
         
}