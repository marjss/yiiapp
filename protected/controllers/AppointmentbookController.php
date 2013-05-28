<?php

class AppointmentbookController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','Signup'),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('getproducts','getservices','getbookedorder','cancelorder','changestatus','getuniqueemail','getuniquemobile','getinvoice','Products','getmultipro','stockcheck','Appservices','CheckexistingStock'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->isMerchant()'
			),
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update'),
				'users'=>array('admin@admin.com'),
			),
                        */
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
        public function actiongetservices(){
            //get the selected services
		if($_POST['services'])
		{
		    $selected_services = $_POST['services'];
		    
		    $crit = new CDbCriteria();
		    $crit->condition = "t.id IN (".$selected_services.")";
		    $services_model = Merservices::model()->findAll($crit);
		    
		    $totaltime = 0;
		    foreach($services_model as $val){
			$totaltime += $val->duration;
		    }
	       
		    echo $totaltime;
		}
		else
			echo 0;
		exit;
        }
	
	public function actiongetbookedorder($id){
		$order = Customerorders::model()->findByPk($id);
		$starttime = date('h:i A',strtotime($order->appointment_date_time));
		$orderdet = new Orderdetails;
		$orderdetails = $orderdet->getBookedorder($id);
		$endtime = $orderdetails['endtime'];
		$content = '<div class="dialog_input">';
		//$content .= '<div class="dialogtitle">Booking with '.$order->customer_name.'</div>';
		$content .='<div id="tobooked_slot" class="tobooked_slot"><b>'.$order->customer_name.'</b><br />'.$order->customer_contact_no;
		$content .='<br />'.$order->customer_email;
		$content .='<br />Booking time:<span id="start_time">'.$starttime;
		$content .='</span> to <span id="end_time">'.$endtime.'</span></div>';
		$content .='<div class="double-process" id="custservices">'.$orderdetails['services'].'</div></div>';
		
		echo $content;
		exit;
	}
        /**check the existing stock with post quantity, if stock is overflow then return false with json details, else true.{Sudhanshu}
         */
        public function actionCheckexistingStock(){
         if($_POST['pro_id']){
                $id=$_POST['pro_id'];
                $quantity = $_POST['quantity'];
                $model = Merservices::model()->findByPk($id);
                if($model){
                    $out = array();
                    if($model->stock < $quantity){
                        
                        $out = array(
				'label' => $model->name,  
				'value' => $model->name,
				'id' => $model->id,
                                'price'=>$model->price,
				'stock'=>$model->stock,
                                'final_result'=>'false'
			    );}else{ $out = array(
				'label' => $model->name,  
				'value' => $model->name,
				'id' => $model->id,
                                'price'=>$model->price,
				'stock'=>$model->stock,
                                'final_result'=>'true'
			    );}
                        echo CJSON::encode($out);
			Yii::app()->end();
                }
            }
            
        }
        /**
         * function to check the product is out of stock or not. return boolean true/false {Sudhanshu}
         */
        public function actionStockcheck(){
            if($_POST['id']){
                $id=$_POST['id'];
                $model = Merservices::model()->findByPk($id);
                if($model){
                    if($model->stock <= 0){ echo 'false';}else{echo 'true';}
		exit;
                }
            }
            
        }
        
        /**
         * Invoice Auto complete fields search function to fetch merchants products and services and return in Json format {Sudhanshu} 
         */
	public function actionProducts(){
		$q = $_GET['term'];
                $id = Yii::app()->user->id;
		if (isset($q)) {
		    $criteria = new CDbCriteria;
//		    $criteria->compare('name',trim($q));
                    $criteria->condition='merchant_id='.$id.' AND status = 1 AND name LIKE "%'.trim($q).'%"';
                    $criteria->distinct = true;
                    $criteria->group = 'name';
		    $criteria->limit = 10;
		    $street = Merservices::model()->findAll($criteria);
                    
		    if (!empty($street)) {
			$out = array();
			foreach ($street as $c) {
			    $out[] = array(
				'label' => $c->name,  
				'value' => $c->name,
				'id' => $c->id,
                                'price'=>$c->price,
				
			    );
			}
			echo CJSON::encode($out);
			Yii::app()->end();
		    }
		}
	}
        /**
         * App Book Auto complete fields search function to fetch merchants services and return in Json format {Sudhanshu} 
         */
	public function actionAppservices(){
		$q = $_GET['term'];
                $id = Yii::app()->user->id;
		if (isset($q)) {
		    $criteria = new CDbCriteria;
//		    $criteria->compare('name',trim($q));
                    $criteria->condition='merchant_id='.$id.' AND status = 1 AND isproduct = 0 AND name LIKE "%'.trim($q).'%"';
                    $criteria->distinct = true;
                    $criteria->group = 'name';
		    $criteria->limit = 10;
		    $services = Merservices::model()->findAll($criteria);
                    
		    if (!empty($services)) {
			$out = array();
			foreach ($services as $c) {
			    $out[] = array(
				'label' => $c->name,  
				'value' => $c->name,
				'id' => $c->id,
                                'price'=>$c->price,
				'duration'=>$c->duration,
			    );
			}
			echo CJSON::encode($out);
			Yii::app()->end();
		    }
		}
	}
        /**
         * function to get products quantities and return in Json format{Sudhanshu}
         */
         public function actionGetmultiPro(){
            $id= Yii::app()->user->id;
            if($_POST['pro_id']){
            $product = $_POST['pro_id'];
            $service = Merservices::model()->findBypk($product);
            $total = $service->price + $subprice;
             if (!empty($service)) {
			$out = array();
                             if($service->isproduct){$out = array(
				'label' => $service->name,  
				'value' => $service->name,
				'id' => $service->id,
                                'price'=>$service->price,
				'stock'=>$service->stock,
			    );}else{
			    $out = array(
				'label' => $service->name,  
				'value' => $service->name,
				'id' => $service->id,
                                'price'=>$service->price,
			    );}
			echo CJSON::encode($out);
			Yii::app()->end();
		    }
              }
        }
       /**
        * function to fetch the merchant products and services list and return in Json format.{Sudhanshu}
        */
        public function actionGetproducts(){
            $id= Yii::app()->user->id;
            $product = $_POST['product'];
            $subprice = $_POST['subprice'];
            if($_POST['product_id']){
            $product_id=$_POST['product_id'];
                    $criteria = new CDbCriteria;
		    $criteria->condition='merchant_id='.$id.' AND status = 1 AND id ='.$product_id.' AND name LIKE "%'.trim($product).'%"';
		    $service = Merservices::model()->find($criteria);
                    
//            $service = Merservices::model()->findByPk($product_id);
            $total = $service->price + $subprice;
		    if (!empty($service)) {
			$out = array();
                        if($service->isproduct){$out = array(
				'label' => $service->name,  
				'value' => $service->name,
				'id' => $service->id,
                                'price'=>$service->price,
				'stock'=>$service->stock,
			    );}else{
			    $out = array(
				'label' => $service->name,  
				'value' => $service->name,
				'id' => $service->id,
                                'price'=>$service->price,
			    );}
			echo CJSON::encode($out);
			Yii::app()->end();
		    }
                    
                    }
        }
        /**
         * function to load the merchants customers invoice in the pop-up.{Sudhanshu}
         */
	public function actiongetinvoice($id){
		$merchant_id = Yii::app()->user->id;
                $order = Customerorders::model()->findByPk($id);
                $customer_id= $order->customer_id;
                $customer_model= Mercustomers::model()->findByPk($customer_id);
                $starttime = date('h:i A',strtotime($order->appointment_date_time));
                $usersettings = MerchantSettings::model()->findByAttributes(array('user_id'=>$merchant_id));
                $orderdet = new Orderdetails;
                $criteria = new CDbCriteria;
		$criteria->condition = "customer_order_id = '".$id."'";
		$orderdetails = Orderdetails::model()->findAll($criteria);
		$endtime = $orderdetails['endtime'];
                
                $loyal= Customerorders::model()->findAllByAttributes(array('customer_id'=>$customer_id));
                $cash= CustomerInvoice::model()->findAllByAttributes(array('customer_id'=>$customer_id,'merchant_id'=>$merchant_id));
                $this->renderPartial('invoice',array(
                    'cash'=>$cash,
                    'order'=>$order,
                    'orderdetails'=>$orderdetails,
                    'usersettings'=>$usersettings,
                    'loyal'=>$loyal,
                    'customer'=>$customer_model,
                    ),false,true);
                
	}
        
	/**
         * function to check the input e-mail is unique for that merchant or not.Return Boolean True/False {Sudhanshu}
         */
	
	public function actiongetuniqueemail(){
		$userid = Yii::app()->user->id;
		
		$crit 				= 	new CDbCriteria;
		$checkEmail 		= 	$_REQUEST['checkEmail'];
		$crit->condition 	= 	"merchant_id = '".$userid."' AND email = '".$checkEmail."'";
		$customers 			= 	Mercustomers::model()->findAll($crit);
		$customercount		=	count($customers);
		/*$emails = array();
		foreach($customers as $val){
			$emails[] = $val->email;
		}
		if(!in_array($_POST['checkMobile'],$emails)){ 
			return true;
		}
		else{ echo "b";die;
			return false;
		}*/
		if($customercount > 0)
		{ 
			echo 'false';
		}
		else
		{
			echo 'true';
		}
		exit;
	}
	/**
         * function to check the input mobile is unique for that merchant or not.Return Boolean True/False {Sudhanshu}
         */
	public function actiongetuniquemobile(){ 
		$userid = Yii::app()->user->id;
		$mobileno = $_REQUEST['checkmoble'];
		$crit = new CDbCriteria;
		$crit->condition = "merchant_id = '".$userid."' AND mobile_no = '".$mobileno."'";
		$customers = Mercustomers::model()->findAll($crit);
		$customercount		=	count($customers);
		
		/*$numbers = array();
		foreach($customers as $val){
			$numbers[] = $val->mobile_no;
		}
		if(!in_array($_POST['checkMobile'],$numbers)){
			return true;
		}
		else{
			return false;
		}*/
		if($customercount > 0)
		{ 
			echo 'false';
		}
		else
		{
			echo 'true';
		}
		die;
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='signup-form1')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
}
