<?php

/**
 * This is the model class for table "dt_customer_invoice".
 *
 * The followings are the available columns in table 'dt_customer_invoice':
 * @property integer $id
 * @property integer $customer_order_id
 * @property integer $service_id
 * @property string $service_name
 * @property integer $service_price
 * @property integer $service_duration
 */
class CustomerInvoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerInvoice the static model class
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
		return 'dt_customer_invoice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id', 'required'),
			array('customer_order_id, service_id, service_price, service_duration', 'numerical', 'integerOnly'=>true),
			array('service_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, customer_order_id, service_id, service_name, service_price, service_duration', 'safe', 'on'=>'search'),
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
			'customer_order_id' => 'Customer Order',
			'service_id' => 'Service',
			'service_name' => 'Service Name',
			'service_price' => 'Service Price',
			'service_duration' => 'Service Duration',
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
		$criteria->compare('customer_order_id',$this->customer_order_id);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('service_name',$this->service_name,true);
		$criteria->compare('service_price',$this->service_price);
		$criteria->compare('service_duration',$this->service_duration);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}