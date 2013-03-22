<?php

/**
 * This is the model class for table "dt_deals".
 *
 * The followings are the available columns in table 'dt_deals':
 * @property integer $id
 * @property integer $merchant_id
 * @property string $title
 * @property string $description
 * @property integer $price
 * @property string $valid
 * @property integer $status
 */
class Deals extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Deals the static model class
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
		return 'dt_deals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('merchant_id, title, offer_price', 'required'),
			array('merchant_id,offer_price, price, status', 'numerical', 'integerOnly'=>true),
			array('title, description,terms', 'length', 'max'=>255),
			array('valid', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, merchant_id, title, description,offer_price, price, valid,terms, status', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'description' => 'Description',
                        'offer_price' => 'Offer Price',
			'price' => 'Price',
			'valid' => 'Valid',
                        'terms' => 'Terms & Conditions',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
                $criteria->compare('offer_price',$this->offer_price);
		$criteria->compare('price',$this->price);
		$criteria->compare('valid',$this->valid,true);
                $criteria->compare('terms',$this->terms,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
//                    'pagination' => array('pageSize' => 2),
		));
	}
	public function mersearch()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
                $id= Yii::app()->user->id;
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('merchant_id',$id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
                $criteria->compare('offer_price',$this->offer_price);
		$criteria->compare('price',$this->price);
		$criteria->compare('valid',$this->valid,true);
                $criteria->compare('terms',$this->terms,true);
		$criteria->compare('status',$this->status);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
//                    'pagination' => array('pageSize' => 2),
		));
	}
        /**
         * Method Override to display Desired Date Format
         */
        protected function afterFind ()
    {
            // convert to display format
        $this->valid = strtotime ($this->valid);
        $this->valid = date ('Y-m-d', $this->valid);

        parent::afterFind ();
    }

    protected function beforeValidate ()
    {
            // convert to storage format
        $this->valid = strtotime ($this->valid);
        $this->valid = date ('Y-m-d', $this->valid);

        return parent::beforeValidate ();
    }
}
