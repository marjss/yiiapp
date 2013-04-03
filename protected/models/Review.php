<?php

/**
 * This is the model class for table "dt_review".
 *
 * The followings are the available columns in table 'dt_review':
 * @property integer $id
 * @property integer $merchant_id
 * @property string $name
 * @property string $email
 * @property integer $mobile
 * @property string $website
 * @property string $review
 * @property string $avtar
 * @property string $date
 * @property integer $status
 */
class Review extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Review the static model class
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
		return 'dt_review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('merchant_id, name, email, review', 'required'),
			array('merchant_id, mobile, status', 'numerical', 'integerOnly'=>true),
			array('name, email, website, avtar', 'length', 'max'=>255),
			array('review', 'length', 'max'=>5000),
			array('date', 'safe'),
                        array('email', 'email'),
                        array('name','checname'),
                    array('review','checreview'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, merchant_id, name, email, mobile, website, review, avtar, date, status', 'safe', 'on'=>'search'),
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
			'email' => 'Email',
			'mobile' => 'Mobile',
			'website' => 'Website',
			'review' => 'Review',
			'avtar' => 'Avtar',
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
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('mobile',$this->mobile);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('review',$this->review,true);
		$criteria->compare('avtar',$this->avtar,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function checname($attribute,$params)
	{
		
		if($this->name === 'Name')
		{
			$this->addError($attribute, 'Name cannot be blank.');
		}
	}
         public function checreview($attribute,$params)
	{
		
		if($this->review === 'Review')
		{
			$this->addError($attribute, 'Review cannot be blank.');
		}
	}
}