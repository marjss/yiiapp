<?php

/**
 * This is the model class for table "dt_merchant_services".
 *
 * The followings are the available columns in table 'dt_merchant_services':
 * @property integer $id
 * @property integer $merchant_id
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property integer $duration
 * @property integer $status
 */
class Merservices extends CActiveRecord
{
	
	public $nearby;
	public $city;
	public $serachresult;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Merservices the static model class
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
		return 'dt_merchant_services';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('merchant_id, price, duration,name, cat_id','required'),
			array('merchant_id, price, duration, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, merchant_id, name, description, price, duration, status, cat_id', 'safe', 'on'=>'search'),
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
			'catmerservice'	=>	array(self::BELONGS_TO, 'CategoryService', 'cat_id'),
                        'merchants'=> array(self::BELONGS_TO,'UserDetails','merchant_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cat_id' => 'Category',
			'merchant_id' => 'Merchant',
			'name' => 'Name',
			'description' => 'Description',
			'price' => 'Price',
			'duration' => 'Duration',
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
		$criteria->with=array('catmerservice');
		$criteria->compare( 'cat_id', $this->cat_id, true );
		$criteria->compare('id',$this->id);
		$criteria->compare('merchant_id',Yii::app()->user->id);
		$criteria->compare('name',$this->name,true);
		//$criteria->compare('t.description',$this->description,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('t.status',$this->status);
//                $criteria->compare('merchants',$this->merchants,true);
//                if(!empty($this->merchant_search)) $criteria->with[] = 'merchants';
//                 if(!empty($this->merchant_search)) $criteria->together = true;
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
//        print_r($criteria);
	}
	
	public function getMerchantServices(){
		$merchant_id = Yii::app()->user->id;
		
		$criteria3 = new CDbCriteria();
		$criteria3->condition = "merchant_id = '".$merchant_id."' AND status = 1";
		$criteria3->order = "name";
		$services = Merservices::model()->findAll($criteria3);
		
		$merchant_services = array();
		foreach($services as $val){
		    $merchant_services[$val->id] = $val->name.'('.$val->duration.' mins) Rs '.$val->price;
		}
		return $merchant_services;
	}
	public function getAllMerchantServices(){
		
		
		$criteria3 = new CDbCriteria();
		$criteria3->order = "name";
                $criteria3->group="name";
		$services = Merservices::model()->findAll($criteria3);
		
		$merchant_services = array();
		foreach($services as $val){
		    $merchant_services[$val->id] = $val->name.'('.$val->duration.' mins) Rs '.$val->price;
		}
		return $merchant_services;
	}
	public function searchsalons()
	{            
		$query = "SELECT u.id, u.featured, u.onlinebooking, u.username, u.email, ud.* FROM dt_users as u, dt_user_details as ud ";
		$query1 = "SELECT COUNT(DISTINCT ud.user_id) as count FROM dt_users as u, dt_user_details as ud ";
		$condition = " WHERE u.id = ud.user_id";
//                echo $query;
		$groupby = "";
		if($_POST)
                {
                   
			$servicename 	= 	$_POST['Merservices']['name'];
			$servicenearby	= 	$_POST['Merservices']['nearby'];
			$city				=	$_POST['Merservices']['city'];
			
			if($servicename == 'e.g. Hair Cut')
			{
				$servicename = '';
			}
			else
			{
				$query .= ", dt_merchant_services as ms";
				$query1 .= ", dt_merchant_services as ms";
				$condition .= " AND u.id = ms.merchant_id AND (ms.name LIKE '%".$servicename."%' OR ud.name LIKE '%".$servicename."%') ";
				$groupby   .= " GROUP BY ms.merchant_id";
			}
			if($servicenearby == 'e.g. Raja Park')
			{
				$servicenearby = '';
			}
			else
			{
				$condition .= " AND ud.street LIKE '%".$servicenearby."%' ";
			}
			if($city)
			{
				$condition .= " AND ud.city= '".$city."' ";
			}
		}
                else
		{                    
			$servicename 	= 	$_REQUEST['name'];
			$servicenearby	= 	$_REQUEST['address'];
			$city				=	$_REQUEST['city'];
			
			if($servicename)
			{
				$query .= ", dt_merchant_services as ms";
				$query1 .= ", dt_merchant_services as ms";
				$condition .= " AND (ms.name LIKE '%".$servicename."%' OR ud.name LIKE '%".$servicename."%') ";
			}
			
			if($servicenearby)
			{
				$condition .= " AND ud.street LIKE '%".$servicenearby."%' ";
			}
			if($city)
			{
				$condition .= " AND ud.city= '".$city."' ";
			}
		}
		
		
		
		
		
		
		$condition .= " AND u.status = 1";
		
		$query = $query.$condition.$groupby;
		$query1 = $query1.$condition.$groupby;
//		echo $query;die;
		$count=Yii::app()->db->createCommand($query1)->queryScalar();
		
		$sql=$query;
                $pages = new CPagination($count);
		$dataProvider = new CSqlDataProvider($sql, array(
			 'totalItemCount'=>$count,
			 'sort'=>array(
				  'attributes'=>array(
						 'id', 'username', 'email',
				  ),
			 ),
			 'pagination'=>array(
				  'pageSize'=>5,
				  'params' => array(
                           'name' => $servicename,
									'address' => $servicenearby,
									'city' => $city,
									 
                    )
			 ),
		));
		
		
		
		/*$criteria->select 	= 	"t.*";
		$criteria->condition = "(t.name='".$servicename."' AND u.address LIKE :address AND u.city='".$city."')";
		$criteria->join		=	"INNER JOIN dt_user_details u ON t.merchant_id = u.user_id ";
		
		$criteria->params 	= 	array(':address' => '%'.trim($servicenearby) . '%'); 
		$criteria->group		=	't.merchant_id';
		//echo "<pre>"; print_r($criteria);die;
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));*/
		
		return $dataProvider;
	}
        public function newsearchsalons()
	{            
		$query = "SELECT u.id as userid, u.featured as featured, u.onlinebooking as online, u.username as username, u.email as email, ud.* FROM dt_users u, dt_user_details ud ";
		$query1 = "SELECT COUNT(DISTINCT ud.user_id) as count FROM dt_users as u, dt_user_details as ud ";
		$condition = " WHERE u.id = ud.user_id";
//                echo $query;
		$groupby = "";
		if($_POST)
                {
//                    echo $query;die;
			$servicename 	= 	$_POST['Merservices']['name'];
			$servicenearby	= 	$_POST['Merservices']['nearby'];
			$city		=	$_POST['Merservices']['city'];
			
			if($servicename == 'e.g. Hair Cut')
			{
				$servicename = '';
			}
			else
			{
				$query .= ", dt_category_service as cs, dt_merchant_services as ms";
				$query1 .= ", dt_category_service as cs, dt_merchant_services as ms";
				$condition .= " AND ms.merchant_id= u.id and (cs.title LIKE '%".$servicename."%' OR ud.name LIKE '%".$servicename."%')  ";
				$groupby   .= " GROUP BY username";
			}
			if($servicenearby == 'e.g. Raja Park')
			{
				$servicenearby = '';
			}
			else
			{
				$condition .= " AND ud.street LIKE '%".$servicenearby."%' ";
			}
			if($city)
			{
				$condition .= " AND ud.city= '".$city."' ";
			}
		}
                else
		{                    
			$servicename 	= 	$_REQUEST['name'];
			$servicenearby	= 	$_REQUEST['address'];
			$city		=	$_REQUEST['city'];
			
			if($servicename)
			{
				$query .= ", dt_merchant_services as ms";
				$query1 .= ", dt_merchant_services as ms";
				$condition .= " AND (ms.name LIKE '%".$servicename."%' OR ud.name LIKE '%".$servicename."%') ";
			}
			
			if($servicenearby)
			{
				$condition .= " AND ud.street LIKE '%".$servicenearby."%' ";
			}
			if($city)
			{
				$condition .= " AND ud.city= '".$city."' ";
			}
		}
		
		
		
		
		
		
		$condition .= " AND u.status = 1";
		
		$query = $query.$condition.$groupby;
//                echo $query;
//                die;
		$query1 = $query1.$condition.$groupby;
//		echo $query;die;
		$count=Yii::app()->db->createCommand($query1)->queryScalar();
		
		$sql=$query;
                $pages = new CPagination($count);
//                echo '<pre>';
//                print_r ($pages);
//                echo '</pre>';
		$dataProvider = new CSqlDataProvider($sql, array(
			 'totalItemCount'=>$count,
			 'sort'=>array(
				  'attributes'=>array(
						 'id', 'username', 'email',
				  ),
			 ),
			 'pagination'=>array(
				  'pageSize'=>5,
				  'params' => array(
                           'name' => $servicename,
                           'address' => $servicenearby,
                           'city' => $city,
									 
                    )
			 ),
		));
		return $dataProvider;
	}
	
	public function getMerchantlist($id)
	{
		echo $id;
	}
}