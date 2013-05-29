<?php

/**
 * This is the model class for table "dt_merchant_seats".
 *
 * The followings are the available columns in table 'dt_merchant_seats':
 * @property integer $id
 * @property integer $merchant_id
 * @property integer $stylist_id
 * @property string $name
 * @property integer $status
 */
class Merseats extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Merseats the static model class
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
		return 'dt_merchant_seats';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('merchant_id,name','required'),
			array('merchant_id, stylist_id, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>20),
                         array('name','UniqueAttributesValidator', 'with'=>'merchant_id','message'=>'{value} has already been taken.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, merchant_id, stylist_id, name, status', 'safe', 'on'=>'search'),
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
			'users' => array(self::BELONGS_TO, 'Users', 'stylist_id'),
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
			'stylist_id' => 'Stylist',
			'name' => 'Name',
			'status' => 'Status',
		);
	}
        public function message(){
            return array('name'=>'This is required');
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
		$criteria->compare('stylist_id',$this->stylist_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getSeats(){
		$merchant_id = Yii::app()->user->id;
		$criteria1 = new CDbCriteria();
		$criteria1->condition = "merchant_id = '".$merchant_id."' AND status = '1'";
		$seats = Merseats::model()->findAll($criteria1);
		
		return $seats;
	}
        public function getSeatsPub($merchant_id){
            
//		$merchant_id = Yii::app()->user->id;
		$criteria1 = new CDbCriteria();
		$criteria1->condition = "merchant_id = '".$merchant_id."' AND status = '1'";
		$seats = Merseats::model()->findAll($criteria1);
		
		return $seats;
	}
        
}
