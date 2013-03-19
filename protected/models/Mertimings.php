<?php

/**
 * This is the model class for table "dt_merchant_timings".
 *
 * The followings are the available columns in table 'dt_merchant_timings':
 * @property integer $id
 * @property integer $merchant_id
 * @property string $day
 * @property string $opening_at
 * @property string $closing_at
 * @property integer $status
 */
class Mertimings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mertimings the static model class
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
		return 'dt_merchant_timings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('merchant_id, status,day,opening_at, closing_at','required'),
			array('merchant_id, status', 'numerical', 'integerOnly'=>true),
			array('day', 'length', 'max'=>225),
			array('opening_at, closing_at,day', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, merchant_id, day, opening_at, closing_at, status', 'safe', 'on'=>'search'),
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
			'day' => 'Day',
			'opening_at' => 'Opening At',
			'closing_at' => 'Closing At',
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
		$criteria->compare('day',$this->day,true);
		$criteria->compare('opening_at',$this->opening_at,true);
		$criteria->compare('closing_at',$this->closing_at,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function getTodayTiming($date,$week_day){
		$merchant_id = Yii::app()->user->id;
		$timing_attributes = array();
		$today_timings = Mertimings::model()->findByAttributes(array('day'=>$week_day,'status'=>1,'merchant_id'=>$merchant_id));
//		echo "<pre>"; print_r($today_timings->attributes); die;
		
		if(isset($today_timings)){
//                     $timezone = "Asia/Calcutta";
//                        date_default_timezone_set($timezone);
//                        $today= strtolower(date('D'));
//			
//                    if($today_timings->day == $today){
//                        if(date("H:i:s")> $today_timings->opening_at)
//                            {
//                        $stime= date("H:i:s");
//                        }
//                        $etime = $today_timings->closing_at;
//                    }else{
                   
			$etime = $today_timings->closing_at;
                        $stime =$today_timings->opening_at;
//                       }
		}
		
		$timing_attributes['stime'] = $stime;
		$timing_attributes['etime'] = $etime;
		
		$x = explode(':',$stime);
		$timing_attributes['starttime'] = $x[0];
		$timing_attributes['sminute'] = $x[1];
		
	       
		$y = explode(':',$etime);
		$timing_attributes['endminute'] = $y[1];
		if($timing_attributes['endminute'] == '00')
		    $timing_attributes['endtime'] = $y[0];
		else
		    $timing_attributes['endtime'] = $y[0]+1;
		    
		$datetime1 = new DateTime($stime);
		$datetime2 = new DateTime($etime);
		
		$interval = $datetime1->diff($datetime2);
		
		$hours   = $interval->format('%h');
		$minutes = $interval->format('%i');
		
		$timing_attributes['totalminutes'] = $hours * 60 + $minutes;
		
		
		$timing_attributes['total_rows']= (int)($timing_attributes['endtime']-$timing_attributes['starttime']);
		$timing_attributes['slot_grids'] = (int)($timing_attributes['totalminutes']/15);
		$timing_attributes['last_timestamp'] = strtotime($date.' '.$timing_attributes['etime']);
		$timing_attributes['first_timestamp'] = strtotime($date.' '.$timing_attributes['stime']);
		$timing_attributes['last_timestring'] = date('g:i A',$timing_attributes['last_timestamp']);
		
		return $timing_attributes;
	}
	
	
}