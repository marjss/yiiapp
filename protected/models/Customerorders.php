<?php

/**
 * This is the model class for table "dt_customer_orders".
 *
 * The followings are the available columns in table 'dt_customer_orders':
 * @property integer $id
 * @property integer $merchant_id
 * @property integer $customer_id
 * @property string $customer_name
 * @property string $customer_address
 * @property string $customer_contact_no
 * @property string $appointment_date_time
 */
class Customerorders extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customerorders the static model class
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
		return 'dt_customer_orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('customer_contact_no','numerical', 'integerOnly'=>true),
                        array('customer_contact_no','length', 'min'=>8 ),
                        array('customer_name, customer_contact_no', 'required'),
			array('merchant_id, customer_id,merchant_seat_id, customer_contact_no', 'numerical', 'integerOnly'=>true),
			array('customer_name, customer_contact_no', 'length', 'max'=>255),
			array('customer_address, appointment_date_time,merchant_seat_name,customer_email', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, merchant_id, customer_id, customer_name,customer_email,status, customer_address, customer_contact_no, appointment_date_time', 'safe', 'on'=>'search'),
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
			'orderdetail' => array(self::HAS_MANY, 'Orderdetails', 'customer_order_id'),
			 'duration' => array(self::STAT, 'Orderdetails', 'customer_order_id',
						'select'=> 'SUM(service_duration)'
						),

			'customer' => array(self::BELONGS_TO, 'Mercustomers', 'customer_id'),
			'seat' => array(self::BELONGS_TO, 'Merseats', 'merchant_seat_id'),
                        'invoices'=>array(self::HAS_MANY, 'CustomerInvoice', 'customer_order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'merchant_id' => 'Merchant',
			'customer_id' => 'Customer',
			'merchant_seat_id' =>'Merchant Seat',
			'merchant_seat_name' =>'Merchant Seat Name',
			'customer_name' => 'Customer Name',
			'customer_email'=> 'Customer Email',
			'customer_address' => 'Customer Address',
			'customer_contact_no' => 'Customer Contact No',
			'appointment_date_time' => 'Appointment Date Time',
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
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('merchant_seat_id',$this->merchant_seat_id);
		$criteria->compare('merchant_seat_name',$this->merchant_seat_name,true);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('customer_name',$this->customer_name,true);
		$criteria->compare('customer_email',$this->customer_email,true);
		$criteria->compare('customer_address',$this->customer_address,true);
		$criteria->compare('customer_contact_no',$this->customer_contact_no,true);
		$criteria->compare('appointment_date_time',$this->appointment_date_time,true);
		$criteria->compare('status',$this->status,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function service()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->compare('customer_id',$this->customer_id);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function gettodayBookedApp($date){
		
		$merchant_id = Yii::app()->user->id;
		
		$crit = new CDbCriteria;
		//$crit->with = 
		$crit->condition = "merchant_id = '".$merchant_id."' AND
					DATE_FORMAT(appointment_date_time, '%Y-%m-%d') = '".$date."' AND status = '1' OR status = '4'";
		$crit->order = " merchant_seat_id ASC,appointment_date_time ASC";
		//$crit->group = 'merchant_seat_id';
		$order_on_day = Customerorders::model()->findAll($crit);
		$merchant_orders = array();
		$i = 0;
		
		
		foreach($order_on_day as $merorder){
			$details = new Orderdetails;
			$services = $details->getBookedorder($merorder->id);
			//echo $services; die;
			$merchant_orders[$merorder->merchant_seat_id][$i] = $merorder->attributes;
			$merchant_orders[$merorder->merchant_seat_id][$i]['duration'] = $merorder->duration;
			$merchant_orders[$merorder->merchant_seat_id][$i]['services1'] = $services['services1'];
			$merchant_orders[$merorder->merchant_seat_id][$i]['starttimestamp'] = strtotime($merorder->appointment_date_time);
			$merchant_orders[$merorder->merchant_seat_id][$i]['endtimestamp'] = strtotime($merorder->appointment_date_time) + $merorder->duration*60;
			$i++;
		}
		
		return $merchant_orders;
	}
        public function gettodayBookedAppPub($merchant_id,$date){
		
//		$merchant_id = Yii::app()->user->id;
		
		$crit = new CDbCriteria;
		//$crit->with = 
		$crit->condition = "merchant_id = '".$merchant_id."' AND
					DATE_FORMAT(appointment_date_time, '%Y-%m-%d') = '".$date."' AND status = '1'";
		$crit->order = " merchant_seat_id ASC,appointment_date_time ASC";
		//$crit->group = 'merchant_seat_id';
		$order_on_day = Customerorders::model()->findAll($crit);
		$merchant_orders = array();
		$i = 0;
		
		
		foreach($order_on_day as $merorder){
			$details = new Orderdetails;
			$services = $details->getBookedorder($merorder->id);
			//echo $services; die;
			$merchant_orders[$merorder->merchant_seat_id][$i] = $merorder->attributes;
			$merchant_orders[$merorder->merchant_seat_id][$i]['duration'] = $merorder->duration;
			$merchant_orders[$merorder->merchant_seat_id][$i]['services1'] = $services['services1'];
			$merchant_orders[$merorder->merchant_seat_id][$i]['starttimestamp'] = strtotime($merorder->appointment_date_time);
			$merchant_orders[$merorder->merchant_seat_id][$i]['endtimestamp'] = strtotime($merorder->appointment_date_time) + $merorder->duration*60;
			$i++;
		}
		return $merchant_orders;
	}
       public function gettodayupdatedAppPub($merchant_id,$date){
		
//		$merchant_id = Yii::app()->user->id;
		
		$crit = new CDbCriteria;
		//$crit->with = 
		$crit->condition = "merchant_id = '".$merchant_id."' AND
					DATE_FORMAT(appointment_date_time, '%Y-%m-%d') = '".$date."' AND status = '3'";
		$crit->order = " merchant_seat_id ASC,appointment_date_time ASC";
		//$crit->group = 'merchant_seat_id';
		$order_on_day = Customerorders::model()->findAll($crit);
		$merchant_orders = array();
		$i = 0;
		
		
		foreach($order_on_day as $merorder){
			$details = new Orderdetails;
			$services = $details->getBookedorder($merorder->id);
			//echo $services; die;
			$merchant_orders[$merorder->merchant_seat_id][$i] = $merorder->attributes;
			$merchant_orders[$merorder->merchant_seat_id][$i]['duration'] = $merorder->duration;
			$merchant_orders[$merorder->merchant_seat_id][$i]['services1'] = $services['services1'];
			$merchant_orders[$merorder->merchant_seat_id][$i]['starttimestamp'] = strtotime($merorder->appointment_date_time);
			$merchant_orders[$merorder->merchant_seat_id][$i]['endtimestamp'] = strtotime($merorder->appointment_date_time) + $merorder->duration*60;
			$i++;
		}
		
		return $merchant_orders;
	} 
	public function gettodayupdatedApp($date){
		
		$merchant_id = Yii::app()->user->id;
		
		$crit = new CDbCriteria;
		//$crit->with = 
		$crit->condition = "merchant_id = '".$merchant_id."' AND
					DATE_FORMAT(appointment_date_time, '%Y-%m-%d') = '".$date."' AND status = '3'";
		$crit->order = " merchant_seat_id ASC,appointment_date_time ASC";
		//$crit->group = 'merchant_seat_id';
		$order_on_day = Customerorders::model()->findAll($crit);
		$merchant_orders = array();
		$i = 0;
		
		
		foreach($order_on_day as $merorder){
			$details = new Orderdetails;
			$services = $details->getBookedorder($merorder->id);
			//echo $services; die;
			$merchant_orders[$merorder->merchant_seat_id][$i] = $merorder->attributes;
			$merchant_orders[$merorder->merchant_seat_id][$i]['duration'] = $merorder->duration;
			$merchant_orders[$merorder->merchant_seat_id][$i]['services1'] = $services['services1'];
			$merchant_orders[$merorder->merchant_seat_id][$i]['starttimestamp'] = strtotime($merorder->appointment_date_time);
			$merchant_orders[$merorder->merchant_seat_id][$i]['endtimestamp'] = strtotime($merorder->appointment_date_time) + $merorder->duration*60;
			$i++;
		}
		
		return $merchant_orders;
	}
	
	public function gettodayBookedOnseat($date,$seat){
		
		$merchant_id = Yii::app()->user->id;
		
		$crit = new CDbCriteria;
		$crit->condition = "merchant_id = '".$merchant_id."' AND  DATE_FORMAT(appointment_date_time, '%Y-%m-%d') = '".$date."' AND merchant_seat_id = '".$seat."'";
		$orders_on_seat = Customerorders::model()->findAll($crit);
		
		return $orders_on_seat;
		//echo "<pre>"; print_r($orders_on_seat); die;
		
	}
	
	public function changeUpdateStatus($id){
		$order = Customerorders::model()->updateByPk($id,array('status'=>4));
	}
}