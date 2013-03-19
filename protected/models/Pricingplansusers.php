<?php

/**
 * This is the model class for table "dt_pricing_plans_users".
 *
 * The followings are the available columns in table 'dt_pricing_plans_users':
 * @property integer $id
 * @property integer $pricing_plan_id
 * @property integer $user_id
 * @property integer $status
 */
class Pricingplansusers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pricingplansusers the static model class
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
		return 'dt_pricing_plans_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pricing_plan_id, user_id, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
                        
			array('id, pricing_plan_id, user_id, status', 'safe', 'on'=>'search'),
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
			'pricingplan' => array(self::BELONGS_TO, 'Pricingplans', 'pricing_plan_id'),
                        
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pricing_plan_id' => 'Pricing Plan',
			'user_id' => 'User',
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
		$criteria->compare('pricing_plan_id',$this->pricing_plan_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
       public function getPlanlistDropDown()
	{
	$query = "SELECT p.name , p.id FROM dt_pricing_plans as p, dt_pricing_plans_users as pud order by name";
		$plans = Pricingplans::model()->findAllBySql($query);
		$data['plans'] = CHtml::listData($plans, 'id');
		return $data['plans'];	
	}
}