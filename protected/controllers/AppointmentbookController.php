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
				'actions'=>array('getservices','getbookedorder','cancelorder','changestatus','getuniqueemail','getuniquemobile'),
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
