<?php

/**
 * This is the model class for table "dt_customer_order_details".
 *
 * The followings are the available columns in table 'dt_customer_order_details':
 * @property integer $id
 * @property integer $customer_order_id
 * @property string $service_name
 * @property integer $service_price
 * @property integer $service_duration
 */
class Orderdetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Orderdetails the static model class
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
		return 'dt_customer_order_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_order_id, service_price, service_duration', 'numerical', 'integerOnly'=>true),
			array('service_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, customer_order_id, service_name, service_price, service_duration', 'safe', 'on'=>'search'),
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
			'customerorder' => array(self::BELONGS_TO, 'Customerorders', 'customer_order_id'),
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
		$criteria->compare('service_name',$this->service_name,true);
		$criteria->compare('service_price',$this->service_price);
		$criteria->compare('service_duration',$this->service_duration);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/*public function service()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('customer_order_id',$this->customer_order_id);
		$criteria->compare('service_name',$this->service_name,true);
		$criteria->compare('service_price',$this->service_price);
		$criteria->compare('service_duration',$this->service_duration);
//                $criteria->compare('customerorder',$this->customerorder,true);
               
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}*/
	public function getBookedorderdetails($model){
		$bookedorders = array();
		$i = 0;
		foreach($model as $value){
			//echo "<pre>"; print_r($value->attributes);
			$duration = 0;
			$criteria = new CDbCriteria;
			$criteria->condition = "customer_order_id = '".$value->id."'";
			$orderdetails = Orderdetails::model()->findAll($criteria);
			foreach($orderdetails as $detail)
			{
			    $duration += $detail->service_duration;
			}
			//echo "<pre>"; print_r($duration);
			//echo "<br />".$timestamp."<br />";
			//echo strtotime($value->appointment_date_time);
			
			$hr = (int)($duration/60);
			$minutes = (int)($duration%60);
			
			$bookedorders[$i]['duration'] = $duration;
			$bookedorders[$i]['starttimestamp'] = strtotime($value->appointment_date_time);
			$bookedorders[$i]['endtimestamp'] = $bookedorders[$i]['starttimestamp'] + $bookedorders[$i]['duration']*60;
			$i++;
			//echo $bookedorders[$val->merchant_seat_id]['apptimemin']; die;
			
		}
		return $bookedorders;
	}
	public function getBookedorder($id){
		$bookedorders = array();
		$order = Customerorders::model()->findByPk($id);
		//echo "<pre>"; print_r($value->attributes);
		$duration = 0;
		$services = array();
		$criteria = new CDbCriteria;
		$criteria->condition = "customer_order_id = '".$id."'";
		$orderdetails = Orderdetails::model()->findAll($criteria);
		foreach($orderdetails as $detail)
		{
		    $bookedorders['duration'] += $detail->service_duration;
		    $servicesid[] = (int)$detail->service_id;
		    $services[]= $detail->service_name.'('.$detail->service_duration.' mins) <span class="WebRupee">Rs</span> '.$detail->service_price;
		    $services1[]= $detail->service_name.'('.$detail->service_duration.' mins) Rs '.$detail->service_price;
		}
		$bookedorders['services'] = implode(', ',$services);
		$bookedorders['services1'] = implode(', ',$services1);
		$bookedorders['serviceids'] = implode(',',$servicesid);
		//echo "<pre>"; print_r($duration);
		//echo "<br />".$timestamp."<br />";
		//echo strtotime($value->appointment_date_time);
	
		$starttime = strtotime($order->appointment_date_time);
		$bookedorders['endtime'] = date("h:i A",($starttime + ($bookedorders['duration']*60)));
		
		return $bookedorders;
	}
	public function sendEmaildelete($id){
		$order = Customerorders::model()->findByPk($id);
		$order_cred = $this->getBookedorder($id);
		
		
		$usercustomer				=	Users::model()->findByPk($order->merchant_id );
		$customerdetail			=	UserDetails::model()->findByAttributes(
												array('user_id'=>$order->merchant_id)
											);
		$model_emailtemplate		=	Emailtemplate::model()->findByPk(1);
		$body							=	$model_emailtemplate->body;
		$body							=	str_replace('$CustomerName', $order->customer_name, $body);
		$create_body				=	'
											 <div>Your appointment with '.$customerdetail->name.' has been cancelled.</div>
											 <br />
											 <div>Here are the details: </div>
											 <div>Date: '.date('d/m/Y',strtotime($order->appointment_date_time)).'</div>
											 <div>Time: '.date('h:i A',$_POST['starttime']).'-'.date('h:i A',$_POST['endtime']).' </div>
											 <div>Stylist: '.$order->seat->name.' </div>
											 <br />
											 <div>For any further assistance, please reply to this email or call us at '.$customerdetail->mobile_no.'.</div>
											';
		$body							=	str_replace('$body', $create_body, $body);
		$body							=	str_replace('$SalonName', $customerdetail->name, $body);
		
		$message 					= new YiiMailMessage;
		$message->setBody($body, 'text/html');
		/*$message->setBody('Your appointment with Style & Scissors for '.date('d/m/Y',strtotime($order->appointment_date_time)).' has been cancelled.<br>
		    Slot: '.date('h:i A',strtotime($order->appointment_date_time)).'-'.$order_cred['endtime'].'.
		    Stylist: '.$order->seat->name.'. Thank you.
		  <b>From</b><br/>
		  Team Salonier ', 'text/html');*/
		$message->subject 	= 'Appointment cancelled with '.$customerdetail->name;
		$message->to 			=  $order->customer_email;
		$message->from 		= $usercustomer->email;
		Yii::app()->mail->send($message);
	}
        public function sendEmailfeedback($id){
		$order = Customerorders::model()->findByPk($id);
		$order_cred = $this->getBookedorder($id);
		$usercustomer =	Users::model()->findByPk($order->merchant_id );
		$customerdetail =UserDetails::model()->findByAttributes(array('user_id'=>$order->merchant_id));
		$model_emailtemplate =	Emailtemplate::model()->findByPk(1);
		$body=	$model_emailtemplate->body;
		$body=	str_replace('$CustomerName', $order->customer_name, $body);
		$create_body=	'<br />Thank you for your visit at '.$customerdetail->name.' Salon. Please reply this mail with your feedback and suggestions to help us improve our services.
				<br /><div>For any further assistance, please reply to this email or call us at '.$customerdetail->mobile_no.'.</div>
											';
		$body	=	str_replace('$body', $create_body, $body);
		$body	=	str_replace('$SalonName', $customerdetail->name, $body);
		
		$message = new YiiMailMessage;
		$message->setBody($body, 'text/html');
		$message->subject 	= 'Service feedback with '.$customerdetail->name;
		$message->to 		=  $order->customer_email;
		$message->from 		= $usercustomer->email;
		Yii::app()->mail->send($message);
	}
        public function sendSms($mobileno,$message){
		
		$request =""; //initialise the request variable
		
		$param[method]= "sendMessage";
		
		$param[send_to] = "91".$mobileno;
		
		$param[msg] = $message;
		
		$param[userid] = "2000033245";
		
		$param[password] = "shyam012";
		
		$param[v] = "1.1";
		
		$param[msg_type] = "TEXT"; //Can be "FLASH?/"UNICODE_TEXT"/?BINARY?
		
		$param[auth_scheme] = "PLAIN";
		
		//Have to URL encode the values
		
		foreach($param as $key=>$val) {
		
			$request.= $key."=".urlencode($val);
			
			//we have to urlencode the values
			
			$request.= "&";
			
			//append the ampersand (&) sign after each parameter/value pair
		
		}
		
		$request = substr($request, 0, strlen($request)-1);
		
		//remove final (&) sign from the request
		
		$url =
		
		"http://enterprise.smsgupshup.com/GatewayAPI/rest?".$request;
		
		$ch = curl_init($url);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$curl_scraped_page = curl_exec($ch);
		
		curl_close($ch);
		
		//echo $curl_scraped_page;
	}
}