<?php

/**
 * This is the model class for table "dt_merchant_holidays".
 *
 * The followings are the available columns in table 'dt_merchant_holidays':
 * @property integer $id
 * @property integer $merchant_id
 * @property string $name
 * @property string $date
 * @property integer $status
 */
class Merholidays extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Merholidays the static model class
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
		return 'dt_merchant_holidays';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('merchant_id,name,date','required'),
			array('merchant_id, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, merchant_id, name, date, status', 'safe', 'on'=>'search'),
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
			'date' => 'Date',
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
		$criteria->compare('merchant_id',Yii::app()->user->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getHolidays(){
		$merchant_id = Yii::app()->user->id;
		
		$criteria2 = new CDbCriteria();
		$criteria2->condition = "merchant_id = '".$merchant_id."' AND status = 1";
		$holidays = Merholidays::model()->findAll($criteria2);
		
		$disabledays = array();
		foreach($holidays as $val){
			$holi = date('Y-m-j',strtotime($val->date));
			$disabledays[] = '"'.$holi.'"';
		}
		$comma_separated = implode(",", $disabledays);
		return $comma_separated;
	}
	
	public function getHolidaysStringtoday(){
		$merchant_id = Yii::app()->user->id;
		
		$criteria2 = new CDbCriteria();
		$criteria2->condition = "merchant_id = '".$merchant_id."' AND status = 1";
		$holidays = Merholidays::model()->findAll($criteria2);
		
		$disabledays = array();
		foreach($holidays as $val){
			$holi = date('Y-m-d',strtotime($val->date));
			$disabledays[] = '"'.$holi.'"';
		}
		$comma_separated = implode(",", $disabledays);
		return $comma_separated;
	}
	
	public function getHolidaystoday(){
		$merchant_id = Yii::app()->user->id;
		
		$criteria2 = new CDbCriteria();
		$criteria2->condition = "merchant_id = '".$merchant_id."' AND status = 1";
		$holidays = Merholidays::model()->findAll($criteria2);
		
		$disabledays = array();
		foreach($holidays as $val){
			
			$disabledays[] = $val->date;
		}
		
		return $disabledays;
	}
}