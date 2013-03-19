<?php

/**
 * This is the model class for table "dt_users".
 *
 * The followings are the available columns in table 'dt_users':
 * @property integer $id
 * @property integer $mas_role_id
 * @property string $username
 * @property string $password
 * @property string $activation_key
 * @property string $status
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'dt_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mas_role_id,username,email,password','required'),
			array('mas_role_id,merchant_id,featured,onlinebooking	', 'numerical', 'integerOnly'=>true),
			array('username, password, activation_key,email', 'length', 'max'=>255),
			array('username,email','unique'),
			array('email','email'),
			//array('merchant_id','safe'),
			array('status', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, mas_role_id, username, password, activation_key,merchant_id, status, email,featured, onlinebooking', 'safe', 'on'=>'search'),
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
			'masrole' => array(self::BELONGS_TO, 'Masroles', 'mas_role_id'),
			'userdetail' =>array(self::HAS_ONE, 'UserDetails','user_id'),
                      
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'mas_role_id' => 'Mas Role',
			'merchant_id'=>'Merchant',
			'username' => 'Username',
			'email'=>'Email',
			'password' => 'Password',
			'activation_key' => 'Activation Key',
			'status' => 'Status',
			'featured' =>'Is Featured Merchant',
			'onlinebooking' => 'Book Online',
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
		$criteria->compare('mas_role_id',$this->mas_role_id);
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('activation_key',$this->activation_key,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getFeaturedsalon()
	{
		$criteria = new CDbCriteria;
		$criteria->select 	= 	"t.id"; 
		$criteria->condition = "t.featured=1 AND t.status = 1";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}