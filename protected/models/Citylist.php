<?php

/**
 * This is the model class for table "dt_citylist".
 *
 * The followings are the available columns in table 'dt_citylist':
 * @property integer $city_id
 * @property string $city_name
 * @property string $latitude
 * @property string $longitude
 * @property string $state
 */
class Citylist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Citylist the static model class
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
		return 'dt_citylist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('city_id, city_name, latitude, longitude, state', 'required'),
			array('city_id', 'numerical', 'integerOnly'=>true),
			array('city_name, state', 'length', 'max'=>50),
			array('latitude, longitude', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('city_id, city_name, latitude, longitude, state', 'safe', 'on'=>'search'),
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
			'city_id' => 'City',
			'city_name' => 'City Name',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'state' => 'State',
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

		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('city_name',$this->city_name,true);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('state',$this->state,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getCitylistDropDown()
	{
		$query = "SELECT c.city_name FROM dt_citylist as c, dt_user_details as ud WHERE c.city_name = ud.city";
		//$criteria = new CDbCriteria;
		//$criteria->order = 'city_name ASC';
		$locations = Citylist::model()->findAllBySql($query);
		
		$data['locations'] = CHtml::listData($locations, 'city_name', 'city_name');
		
		return $data['locations'];
	}
        public function getCityuserDropDown()
	{
//		$query = "SELECT c.city_name FROM dt_citylist as c, dt_user_details as ud order by city_name";
//		$locations = Citylist::model()->findAllBySql($query);
		$data['locations'] = CHtml::listData(Citylist::model()->findAll(array('order'=>'city_name')), 'city_name', 'city_name');
		return $data['locations'];
	}
        public function getCitylist($city)
	{
		$query = "SELECT c.city_name FROM dt_citylist as c WHERE c.city_name ='".$city."'";
		//$criteria = new CDbCriteria;
		//$criteria->order = 'city_name ASC';
		$locations = Citylist::model()->findAllBySql($query);
		$data['locations'] = CHtml::listData($locations, 'city_name', 'city_name');
		
		return $data['locations'];
	}
}