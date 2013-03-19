<?php

/**
 * This is the model class for table "dt_merchant_customers".
 *
 * The followings are the available columns in table 'dt_merchant_customers':
 * @property integer $id
 * @property integer $merchant_id
 * @property string $name
 * @property string $mobile_no
 * @property string $city
 */
class Mercustomers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mercustomers the static model class
	 */
	public $customerinfo;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dt_merchant_customers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('mobile_no','length', 'min'=>10 ),
                        array('email','email'),
                        array('mobile_no','numerical', 'integerOnly'=>true),
			array('name, mobile_no,email', 'required'),
			array('merchant_id', 'numerical', 'integerOnly'=>true),
			array('name, mobile_no,email, city', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, merchant_id, name, mobile_no, city,email', 'safe', 'on'=>'search'),
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
			'merchant_id' => 'Merchant',
			'name' => 'Name',
			'mobile_no' => 'Mobile No',
			'city' => 'City',
			'email'=>'Email',
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
		$criteria->compare('merchant_id',Yii::app()->user->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('mobile_no',$this->mobile_no,true);
		$criteria->compare('city',$this->city,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getCustomerinfo() {
		// presuming PostCode, City and Province are fields
		return $this->name . ',' . $this->mobile_no; 
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