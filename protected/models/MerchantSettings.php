<?php

/**
 * This is the model class for table "dt_merchant_settings".
 *
 * The followings are the available columns in table 'dt_merchant_settings':
 * @property integer $id
 * @property integer $user_id
 * @property string $tax
 * @property string $vat
 * @property integer $status
 */
class MerchantSettings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MerchantSettings the static model class
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
		return 'dt_merchant_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('user_id, status', 'numerical', 'integerOnly'=>true),
			array('tax, vat', 'length', 'max'=>255),
                        array('tax, vat', 'numerical','min'=>0,'tooSmall'=>'{attribute} cannot be negative!'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, tax, vat, status', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'tax' => 'Tax',
			'vat' => 'Vat',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('tax',$this->tax,true);
		$criteria->compare('vat',$this->vat,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}