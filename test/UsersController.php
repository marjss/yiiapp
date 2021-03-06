<?php

class UsersController extends Controller
{
	public $avatarPath = 'avtar';
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','Signup','ActiveMeracc','forgotpass','activemail'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('ChangePassword','Appointment', 'Bookappointment', 'Deleteappointment','findCustomerinfo','Settings', 'Account', 'Deleteavtar'),
				'users'=>array('@'),
				//'redirect'=>Yii::app()->params['loginUrl'],
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update'),
				'users'=>array('admin@admin.com'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout = 'admin_layout';
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	/**
	 * Register of merchant.
	 * @param No params
	 */
	public function actionSignup(){
		//echo Yii::app()->user->adminEmail(); die;
		//echo gethostbyaddr($_SERVER['SERVER_ADDR']); die;
		//echo $_SERVER["SERVER_NAME"]; die;
		if($_REQUEST['plan']){
			$plan = Pricingplans::model()->findByPk($_REQUEST['plan']);
			if($plan == null){
				throw new CHttpException(404,'You are not authorize to acess this page.');
			}
		}
		else{
			throw new CHttpException(404,'You are not authorize to acess this page.');
		}
		
		if(Yii::app()->user->id){
			$this->redirect(Yii::app()->request->baseUrl);
		}
		$this->layout = 'front_layout';
                
		$model = new UserRegister;
		$this->performAjaxValidation($model);
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='signup-form1')
		{
			
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		
		if(isset($_POST['UserRegister']))
		{
			
			$model->attributes = $_POST['UserRegister'];
			
			//echo "<pre>"; var_dump($model->validate());die;
			if($model->validate()){
				//echo 'test';die;
				$user = new Users;
				$user->attributes = $_POST['UserRegister'];
				//$model->attributes=$_POST['UserRegister'];
				$password = $_POST['UserRegister']['password'];
				$user->password = md5($password);
				$userrole = Masroles::model()->findByAttributes(array('name'=>'Merchant'));
				$user->mas_role_id = $userrole->id;
				$user->activation_key = $this->createRandomString();
				$user->status = 0;
				
				/* Code from Activation link start here*/
				$user->status = 1;
				$user->activation_key = 0;
				$user->mas_role_id = 2;
				$user->merchant_id = 0;
				/*  Code from Activation link ends here*/
				
				if($user->save()){
					$userdetails = new UserDetails;
					$userdetails->attributes =  $_POST['UserRegister'];;
					$userdetails->user_id = $user->id;
					if($userdetails->save()){
						$userplans = new Pricingplansusers;
						$userplans->user_id = $user->id;
						$userplans->pricing_plan_id = $_POST['pricingplan'];
						$userplans->status = 0;
						if($userplans->save()){
							
							
							/* Code from Activation link start here*/
							
								$planuser = Pricingplansusers::model()->findByAttributes(array('user_id'=>$user->id));
								$planuser->status = 1;
								if($planuser->save()){
									
									//Assign admin defined services to Merchant
									$admin_services = Services::model()->findAll();
									foreach($admin_services as $val){
										$mer_services = new Merservices;
										$mer_services->attributes = $val->attributes;
										$mer_services->merchant_id = $user->id;
										$mer_services->status = 1;
										$mer_services->save();
									}
									
									if($planuser->pricingplan->stylists > 0){
										for($i=1;$i<=$planuser->pricingplan->stylists;$i++){
											$merseats = new Merseats;
											$merseats->merchant_id = $user->id;
											$merseats->name = 'Stylist '.$i;
											$merseats->status = 1;
											$merseats->save();
										}
									}
									else{
										for($i=1;$i<=10;$i++){
											$merseats = new Merseats;
											$merseats->merchant_id = $user->id;
											$merseats->name = 'Seat'.$i;
											$merseats->status = 1;
											$merseats->save();
										}
									}
									
									$days = array('1'=>'mon','2'=>'tue','3'=>'wed','4'=>'thu','5'=>'fri','6'=>'sat','7'=>'sun');
									for($i=1;$i<=7;$i++){
										$mertimings = new Mertimings;
										$mertimings->merchant_id = $user->id;
										$mertimings->day =$days[$i] ;
										$mertimings->opening_at = '09:00:00';
										$mertimings->closing_at = '19:00:00';
										$mertimings->off = 0;
										$mertimings->status = 1;
										$mertimings->save();
									}
									
									$userdetails = UserDetails::model()->findByAttributes(array('user_id'=>$user->id));
									
									$model_emailtemplate	=	Emailtemplate::model()->findByPk(1);
									$body						=	$model_emailtemplate->body;
									/*$body						=	str_replace('$CustomerName', 'Shiv', $body);
									$body						=	str_replace('$body', 'Here is the content would go', $body);
									$body						=	str_replace('$SalonName', 'Staff', $body);*/
									
									
									$message 				= 	new YiiMailMessage;
									$register_body			=	$body;
									$register_body			=	str_replace('$CustomerName', $_POST['UserRegister']['username'], $register_body);
									$create_registerbody	=	'<div>elcome and thank you for joining Salon Chimp.</div>
				
																	<div>Your unique URL:</div>
				
																	<div>http://'.$_POST['UserRegister']['username'].'.salonchimp.com</div>
																	<br /><br />
																	
																	<div>Your admin credentails are:</div>
																	<br />
																	<div>http://salonchimp.com/login</div>
																	<div>Username: '.$_POST['UserRegister']['username'].'</div>
																	<div>Password: '.$_POST['UserRegister']['password'].'</div>
																	<br /><br /><br />
																	 
																	
																	
																	<div>Salon Chimp is not only an appointment management tool but also a complete solution for your salon from  appointments to billing to business promotion tool.</div>
																	<br />
																	<div>What to do Next?</div>
																	<br />
																	<ol>
																	<li> Login to your admin area to control everything.  Go to settings tab and see what things can be controlled.</li>
																	
																	<li> Update your stylists names, timings and services . </li>
																	
																	<li> Keep mentioning your unique URL everywhere like on your business cards and your email signatures. </li>
																	
																	<li> Integrate Salon Chimp directly on your website.  Create a book now link to your unique URL or just copy a single line code on your website to show your free time slots. </li>
																	</ol>
																	<br />
																	<br />
																	
																	<div>And, yes, If you have any kind of questions, please feel free to contact us anytime at care@salonchimp.com</div>
																	
																	<div>Thanks for your support and if you like our service, please do not forget to tell your friend about us</div>';
									$register_body			=	str_replace('$body', $create_registerbody, $register_body);
									$register_body			=	str_replace('$SalonName', 'Team SalonChimp', $register_body);
									
									$message = new YiiMailMessage;
									$message->setBody($register_body, 'text/html');
									$message->subject = 'Welcome to Salon Chimp';
									$message->to = $user->email;
									$message->from = Yii::app()->user->adminEmail();
									Yii::app()->mail->send($message);
									
									
									$message = new YiiMailMessage;
									$message->setBody('A merchant has been successfully registerd on SalonChimp <br/><br/>
									  Details are:<br/> <br/>
									  Business Name: '.$userdetails->name.'<br />
									  Username: '.$user->username.'<br />
										Email: '.$user->email.'<br />
									  Contact No.: '.$userdetails->mobile_no.'<br />
									  <b>From</b><br/>
									  Team SalonChimp ', 'text/html');
									$message->subject = 'SalonChimp : A Merchant registered';
									$message->to = 'pareekshyam@gmail.com';
									$message->from = Yii::app()->user->adminEmail();
									Yii::app()->mail->send($message);
									
									$modelLogin = new LoginForm;
									$modelLogin->email = $_POST['UserRegister']['email'];
									$modelLogin->password = $_POST['UserRegister']['password'];
									$modelLogin->rememberMe = 0;
									
									if($modelLogin->login()){
										$user_id = Yii::app()->user->id;
										$record=Users::model()->findByPk($user_id);
										if($record->masrole->name == 'Admin')
											$this->redirect(array('//users/admin'));
										if($record->masrole->name == 'Merchant'){
											$this->redirect(array('//users/appointment','user'=>$record->username));
											//$this->redirect(array('//users/settings','user'=>$record->username));
											//$this->redirect(array('//users/appointment'));
										}
									
								}
							
							/* Code from Activation link ends here*/
							}
							else
							{
								
							}
							
							/* Activation link code start here*/
							/*$message = new YiiMailMessage;
							$message->setBody('Welcome '. $model->name .', <br/><br/>
							  To verify your account on Salonier please click on below url:<br/> <br/>
							 <a href="http://'.$_SERVER["SERVER_NAME"].Yii::app()->request->baseUrl.'/users/ActiveMeracc?act_key='.$user->activation_key.'">http://'.$_SERVER["SERVER_NAME"].Yii::app()->request->baseUrl.'/users/ActiveMeracc?act_key='.$user->activation_key.'</a><br /><br /><br />
							  <b>From</b><br/>
							  Team SalonChimp ', 'text/html');
							$message->subject = 'SalonChimp : Account Created';
							$message->to = $model->email;
							$message->from = Yii::app()->user->adminEmail();
							Yii::app()->mail->send($message);*/
						}
						echo "out";die;
					}
				
					//echo $password;die;
							
					$this->redirect(Yii::app()->request->baseUrl.'/users/activemail');
				}
			}
			
		}
		
		if($_REQUEST['plan']){
			$plan = Pricingplans::model()->findByPk($_REQUEST['plan']);
		}
		/*if($_GET['flag'] == 'mailsent'){
			Yii::app()->user->setFlash('mailsent','A mail has been sent to your email, please activate your account.');
		}
		*/
		$this->render('signup',array('model'=>$model,'pricingplan'=>$plan));
	}
	
	public function actionactivemail(){
		$this->layout = 'front_layout';
		$this->render('accountactive');
	}
	
	public function actionForgotpass()
	{
		$this->layout = 'front_layout';
		$model=new Forgotpass;
		
		$this->performAjaxValidation($model);
		
		if(isset($_POST['Forgotpass']))
		{
			$model->attributes=$_POST['Forgotpass'];
			if($model->validate()){
				$email = $_POST['Forgotpass']['email'];
				$record=Users::model()->findByAttributes(array('email'=>$email));
				if($record==null)
				{
					$model->addError('email','Invalid email address.');
				}
				else
				{
					//echo '<pre>'; print_r($record->password);die;
					$password 				= $this->createPwdString();
					$model_emailtemplate	=	Emailtemplate::model()->findByPk(1);
					$body						=	$model_emailtemplate->body;
					$body						=	str_replace('$CustomerName', $record->username, $body);
					$create_body			=	'<div>We have reset your password as per your request.</div>
													<br />
													<br />

													<div>Your new password is: '.$password.'</div>
													<br />
													<br />
													<div>For any further assistance, please reply to this email or call us at '.Yii::app()->user->merchantcontactno().'.</div>';
					$body						=	str_replace('$body', $create_body, $body);
					$body						=	str_replace('$SalonName', 'Team Salon Chimp', $body);
					$record->password = md5($password);
					if($record->save()){
						$message = new YiiMailMessage;
						$message->setBody($body, 'text/html');
						$message->subject = 'Forgot Password?';
						$message->to = $record->email;
						$message->from = Yii::app()->user->adminEmail();
						Yii::app()->mail->send($message);
						
						Yii::app()->user->setFlash('forgotpass','Password has been sent to your mail address ! ');
						$this->redirect(Yii::app()->request->baseUrl.'/login?change=1');
					}
					//echo $password;die;
					
				}
				
				//$this->redirect(array('view','id'=>$model->id));
			}
		}
		$this->render('forgotpass',array('model'=>$model));
		
	}
	
	/**
	 *Create random string for activation key
	 * @param integer $id the ID of the model to be displayed
	 */
	private function createRandomString() {
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;
		while ($i <= 19)
		{
		    $num = rand() % 33;
		    $tmp = substr($chars, $num, 1);
		    $pass = $pass . $tmp;
		    $i++;
		}
		return $pass;
        }
	
	/**
	 *Create random string for activation key
	 * @param integer $id the ID of the model to be displayed
	 */
	private function createPwdString() {
		$chars = "abcdefghijkmnopqrstuvwxyz0123456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;
		while ($i <= 5)
		{
		    $num = rand() % 33;
		    $tmp = substr($chars, $num, 1);
		    $pass = $pass . $tmp;
		    $i++;
		}
		return $pass;
        }
	/**
	 * change password
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionChangePassword()
	{
	
		$this->layout = "controlpanel";
		$user_id = Yii::app()->user->id;
		//echo $user_id; die;
		$model = $this->loadModel($user_id);
		
		$modelpass = new ChangePassword;
		$uid = Yii::app()->user->id;
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='cpwd-form')
		{
			
			echo CActiveForm::validate($modelpass);
			Yii::app()->end();
		}
                
		if(isset($_POST['ChangePassword']))
		{
			$modelpass->attributes = $_POST['ChangePassword'];
			
			if($modelpass->validate())
			{
				//echo '<pre>'; print_r($_POST['ChangePassword']);die;
				$user= Users::model()->findByPk($_POST['ChangePassword']['id']);
				
				if(md5($modelpass->oldpassword) == $user->password)
				{
					$user->password = md5($modelpass->newpassword);
					if($user->save())
					{
						Yii::app()->user->setFlash('success','Password changed successfully ! ');
						$this->refresh();
						
					}
				}
				else
				{
					Yii::app()->user->setFlash('error','Incorrect old password ! ');
					$this->refresh();
				}
			}
                }
		//$this->layout='column3';
                $this->render('changepassword',array(
			'model'=>$model, 'modelpass'=>$modelpass, 'uid'=>$uid
				));
			
	}
	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->layout = 'admin_layout';
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			$model->password = md5($_POST['Users']['password']);
			$model->activation_key = 0;
			$model->status = 1;
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->layout = 'admin_layout';
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			if($model->password == $_POST['Users']['password'])
			{
				$password = $_POST['Users']['password'];
			}
			else
			{
				$password = md5($_POST['Users']['password']);
			}
			$model->attributes=$_POST['Users'];
			$model->password = $password;
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->layout = 'admin_layout';
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout = 'admin_layout';
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionDeleteavtar()
	{
		$this->layout 	= 	'front_layout';
		$model 			= 	UserDetails::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
		$avtarimage 	= 	$model->avtar;
		
		$filename 		= 	$avtarimage;
		$thumbavtar    = explode("/",$filename);
		$thumbfilename = $thumbavtar[0]."/thumb/".$thumbavtar[1];
		unlink($filename);
		unlink($thumbfilename); 
		$model->avtar = '';
		$model->save();
		$this->redirect(array('account'));

	}

	public function actionAccount()
	{
		$this->layout 	= 	'front_layout';
		$model 			= 	UserDetails::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		
		if(isset($_POST['UserDetails']))
		{ //echo $_FILES['UserDetails']['name']['avtar'];die;
			$avtarimage = $model->avtar;
			$model->attributes = $_POST['UserDetails'];
			if($_FILES['UserDetails']['name']['avtar'] != '')
			{ 
				$model->avtar = CUploadedFile::getInstanceByName('UserDetails[avtar]');
				if($model->validate()) {
					if ($model->avtar instanceof CUploadedFile) {
						$filename = $this->avatarPath .'/'.  $model->user_id . '_' . $_FILES['UserDetails']['name']['avtar'];
						$thumbfilename = $this->avatarPath .'/thumb/'.  $model->user_id . '_' . $_FILES['UserDetails']['name']['avtar'];
						//echo $filename;die;
						$model->avtar->saveAs($filename);
						copy($filename,$thumbfilename);
						list($width, $height, $type, $attr) = getimagesize($filename);
						$image = Yii::app()->image->load($filename);
						$image->resize(190, 192,Image::HEIGHT);
						$image->save();
						
						$image = Yii::app()->image->load($thumbfilename);
						$image->resize(50, 50);
						$image->save();
						
						$model->avtar = $filename;
					}
				}
			}
			else
			{
				$model->avtar = $avtarimage;
			}
			if($model->save())
				$this->redirect(array('account'));
		}

		$this->render('account',array('model'=>$model));
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
	
	public function getStatus($data,$row)
	{
	   switch($data->status)
		     {
			     case 1:
				     return 'Active';
			     break;
			     case 0:
				     return 'Inactive';
			     break;
			     
		     }
	}
	
	public function gettemplate($data,$row)
	{
	   switch($data->masrole->name)
		     {
			     case 'Admin':
				     return '{view}';
			     break;
			     default:
				     return '{view}{update}{delete}';
			     break;
			     
		     }
	}
	
	public function getidadmin($data,$row){
		return ++$row;
	}
	
	public function actionAppointment(){
		
		if($_POST['orderid'] && $_POST['operation'] == 'delete')
		{
			$order = Customerorders::model()->updateByPk($_POST['orderid'],array('status'=>2));
			$details = new Orderdetails;
			$details->sendEmaildelete($_POST['orderid']);
		}
		if($_POST['orderid'] && $_POST['operation'] == 'update')
		{
			$order = Customerorders::model()->updateByPk($_POST['orderid'],array('status'=>3));
			//$details = new Orderdetails;
			//$details->sendEmaildelete($_POST['orderid']);
		}
		
		if($_POST['date']){
			$this->layout = "controlpanel";
			/*$assetUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.qtip.source'));
			Yii::app()->clientScript->registerScriptFile($assetUrl.'/jquery.qtip-1.0.0-rc3.min.js');
			*/
			$date = $_POST['date'];		
			$week_day = strtolower(date('D',strtotime($date)));
			//Yii::import('application.extensions.qtip.QTip');
			
		}
		else{
			$this->layout = 'controlpanel';	
			$date = date('Y-m-d');
			$week_day = strtolower(date('D'));
		}
		//get today's timing attributes
		$mertimings = new Mertimings;
		$mertimings_attr = $mertimings->getTodayTiming($date,$week_day);
		$timestamp = strtotime($date.' '.$mertimings_attr['stime']);
		if($mertimings_attr['slot_grids'] == 0){
			$this->redirect(array('mertimings/admin'));
		}
		else{
			$merchant_id = Yii::app()->user->id;
	    
			//get merchant's seats
			$merseats = new Merseats;
			$seats = $merseats->getSeats();
			
			
			$model = new Mercustomers;
			//get holidays's dates if exists
			$merholidays = new Merholidays;
			$disabledays = $merholidays->getHolidays();
			
			$holi = new Merholidays;
			$disabledayarray = $holi->getHolidaystoday();
			
			$holi1 = new Merholidays;
			$disabledayarray1 = $holi1->getHolidaysStringtoday();
			
			//echo "<pre>"; print_r($disabledays); die;
			//get merchant services
			$merservices = new Merservices;
			$merchant_services = $merservices->getMerchantServices();
			
			
			//get today's booked appointment
			$custorders = new Customerorders;
			$booked_orders = $custorders->gettodayBookedApp($date);
			
			//get today's updated appointment
			$custorders1 = new Customerorders;
			$update_orders = $custorders->gettodayupdatedApp($date);
			
			
			
			//get the array according to seats
			$appointment_book = array();
			foreach($seats as $seat){
				for($i = 0; $i<$mertimings_attr['slot_grids'];$i++){
					
					$currenttime = $timestamp + 15*60*$i;
					if(in_array($date,$disabledayarray)){
						$appointment_book[$seat->id][$currenttime]= 'disable';
					}
					else{
						$appointment_book[$seat->id][$currenttime]= '';
					}
					if($booked_orders[$seat->id]){
						
						foreach($booked_orders[$seat->id] as $key=>$order){
							
							if($currenttime >= $order['starttimestamp'] && $currenttime  < $order['endtimestamp'] )
							{				
								$appointment_book[$seat->id][$currenttime]=$order;
							}
						}
					}
					if($update_orders[$seat->id]){
						
						foreach($update_orders[$seat->id] as $key=>$order){
							
							if($currenttime >= $order['starttimestamp'] && $currenttime  < $order['endtimestamp'] )
							{				
								$appointment_book[$seat->id][$currenttime]=$order;
							}
						}
					}
					
				}
			
			}
			//echo "<pre>"; print_r($appointment_book); die;
			$this->render('appointmentbook',array('merchant_services'=>$merchant_services,'mertimings_attr'=>$mertimings_attr,
							      'seats'=>$seats,'model'=>$model,'appointment_book'=>$appointment_book,'date'=>$date,'disabledays'=>$disabledays,'disabletoday'=>$disabledayarray1));
			
			if($_POST['date']){
				exit;
			}
		}
	}
	
	
	public function actionDeleteappointment()
	{
			$this->layout = false;
			$order 	= Customerorders::model()->updateByPk($_POST['orderid'],array('status'=>2));
			$details = new Orderdetails;
			$details->sendEmaildelete($_POST['orderid']);
			
			$crit = new CDbCriteria;
			$crit->condition = "customer_order_id  = '".$_POST['orderid']."'";
			$orderdetails = Orderdetails::model()->findAll($crit);
			$totaltime  = 0;
			foreach($orderdetails as $od){
				$totaltime += $od->service_duration;
				
			}
			$data['result'] 		= 'success';
			$data['cancelid']		= $_POST['cancelid']	;
			$data['totaltime']	=	$totaltime;
			echo CJavaScript::jsonEncode($data);
			Yii::app()->end();
	}
	public function actionBookappointment()
	{ 
	
			$this->layout=false;
		//$endtime; $slctd_services; $sms_email, $starttime;
			$data					=	array();
			$data['result'] 	= 'failed';
			if($_POST)
			{
				$merchant_id 		= Yii::app()->user->id;
				$model 				= new Mercustomers;
				$customerform 		= new CustomerForm;
				$customer_order 	= new Customerorders;
				
				$this->performAjaxValidation($customerform);
				
				$valid			=	$model->validate();
				
				if(isset($_POST['ajax']) && $_POST['ajax']==='booking-form')
				{
						  echo CActiveForm::validate($customerform);
						  Yii::app()->end();
				}
				
				$customer_order->merchant_id					=	$merchant_id;
				$customer_order->customer_id					=	$_POST['customerid'];
				$customer_order->merchant_seat_id			=	$_POST['seatid'];
				$customer_order->merchant_seat_name			=	$_POST['seatid_name'];
				$customer_order->customer_name				=	$_POST['customer_name'];
				$customer_order->customer_email				=	$_POST['customer_email'];
				$customer_order->customer_address			=	$_POST['customer_address'];
				$customer_order->customer_contact_no		=	$_POST['customer_contact_no'];
				$customer_order->appointment_date_time		=	date('Y-m-d H:i:s',$_POST['starttime']);
				//$customer_order->send_sms						=	0;
				//$customer_order->send_email					=	0;
				$customer_order->status							=	1;
	
        
           
            if($_POST['sms'] == 'sms'){
               $customer_order->send_sms			=	 1;
            }
            if($_POST['smsemail'] == 'email'){
                $customer_order->send_email 		= 1;
            }
            if($_POST['customerid']){
					$customer = Mercustomers::model()->findByPk($_POST['customerid']);
					$customer_order->customer_id 					= 	$customer->id;
					$customer_order->customer_name 				= 	$customer->name;
					$customer_order->customer_contact_no 		= 	$customer->mobile_no;
					$customer_order->customer_email 				= 	$customer->email;
					$customer_order->customer_address 			= 	$customer->city;
					$customername										=	$customer->name;
					$contactno											=	$customer->mobile_no;
            }
            else
            {
                
					$customer = new Mercustomers;
					$customer->merchant_id 				= $merchant_id;
					$customer->name 						= $_POST['customer_name'];
					$customer->mobile_no 				= $_POST['customer_contact_no'];
					$customer->email 			  			= $_POST['customer_email'];
					//$customer->city = $_POST['Customerorders']['customer_contact_no'];
					$customer->save();
					
					$customername							=	$customer->name;
					$contactno								=	$customer->mobile_no;
            }
            if($customer_order->save()){
                if($_POST['sms'] == 'sms'){
                    $message1 = "Your appointment with ".$customerdetail->name." for ".date('d/m/Y',strtotime($customer_order->appointment_date_time))." has been confirmed. \n
                        Slot: ".date('h:i A',$_POST['starttime'])."-".date('h:i A',$_POST['endtime']).".
                        Stylist: ".$customer_order->seat->name.". \n Thank you.";
                    $model->sendSms($customer_order->customer_contact_no,$message1);
               }
               if($_POST['smsemail'] == 'email'){
						  
							$usercustomer				=	Users::model()->findByPk(Yii::app()->user->id);
							$customerdetail			=	UserDetails::model()->findByAttributes(
																		  array('user_id'=>Yii::app()->user->id)
																);
							$message 					= new YiiMailMessage;
							$model_emailtemplate		=	Emailtemplate::model()->findByPk(1);
							$body							=	$model_emailtemplate->body;
							$body							=	str_replace('$CustomerName', $customer->name, $body);
							$create_body				=	'
																 <div>Your appointment with '.$customerdetail->name.' has been confirmed.</div>
																 <br />
																 <div>Here are the details: </div>
																 <div>Date: '.date('Y-m-d',$_POST['starttime']).'</div>
																 <div>Time: '.date('h:i A',$_POST['starttime']).'-'.date('h:i A',$_POST['endtime']).' </div>
																 <div>Stylist: '.$customer_order->seat->name.' </div>
																 <br />
																 <div>For any further assistance, please reply to this email or call us at '.$customerdetail->mobile_no.'.</div>
																 ';
							$body							=	str_replace('$body', $create_body, $body);
							$body							=	str_replace('$SalonName', $customerdetail->name, $body);
							$message->setBody($body, 'text/html');
							$message->subject 			= 'Appointment confirmed with '.$customerdetail->name;
							$message->to 				=  $customer_order->customer_email;
							$message->from				= 	$usercustomer->email;
							Yii::app()->mail->send($message);
					}
                
					$services =$_POST['slctd_services'];
					$x = explode(',',$services);
					$y = "'" . implode("','", $x) . "'"; 
					$crit = new CDbCriteria;
					$crit->condition = "id IN (".$y.") AND merchant_id = '".$merchant_id."' AND status = 1";
					$cust_services = Merservices::model()->findAll($crit);
					$tooltip  = 0;
					foreach($cust_services as $cs){
						 $orderdetail = new Orderdetails;
						 $orderdetail->customer_order_id = $customer_order->id;
						 $orderdetail->service_id = $cs->id;
						 $orderdetail->service_name = $cs->name;
						 $orderdetail->service_price = $cs->price;
						 $orderdetail->service_duration = $cs->duration;
						 $orderdetail->save();
						 if($tooltip == 0)
						 {
							$tooltip = $cs->name."(".$cs->duration." mins) Rs ".$cs->price;
						 }
						 else
						 {
							$tooltip = $cs->name."(".$cs->duration." mins) Rs ".$cs->price;
						 }
					}
					$data['seatid']			=	$_POST['seatid'];
					$data['starttime']		=	$_POST['starttime'];
					$data['endtime']			=	$_POST['endtime'];
					$data['customername']	=	$customername;
					$data['contactno']		=	$contactno;
					$data['booked']			=	$_POST['bookedslots'];
					$data['tooltip']			=	$tooltip;
					$data['orderid']			=	$customer_order->id;
					$data['result'] 			= 'success';
            }
         }
			echo CJavaScript::jsonEncode($data);
			Yii::app()->end();
	}
	
	public function actionActiveMeracc(){
		$ackkey = $_REQUEST['act_key'];
		$user = Users::model()->findByAttributes(array('activation_key'=>$ackkey));
		
		if($user == null){
			throw new CHttpException(404,'You are not authorize to acess this page.');
		}
		else{
			$user->status = 1;
			$user->activation_key = 0;
			$user->mas_role_id = 2;
			$user->merchant_id = 0;
			if($user->save()){
				$planuser = Pricingplansusers::model()->findByAttributes(array('user_id'=>$user->id));
				$planuser->status = 1;
				if($planuser->save()){
					
					//Assign admin defined services to Merchant
					$admin_services = Services::model()->findAll();
					foreach($admin_services as $val){
						$mer_services = new Merservices;
						$mer_services->attributes = $val->attributes;
						$mer_services->merchant_id = $user->id;
						$mer_services->status = 1;
						$mer_services->save();
					}
					
					if($planuser->pricingplan->stylists > 0){
						for($i=1;$i<=$planuser->pricingplan->stylists;$i++){
							$merseats = new Merseats;
							$merseats->merchant_id = $user->id;
							$merseats->name = 'Stylist '.$i;
							$merseats->status = 1;
							$merseats->save();
						}
					}
					else{
						for($i=1;$i<=10;$i++){
							$merseats = new Merseats;
							$merseats->merchant_id = $user->id;
							$merseats->name = 'Seat'.$i;
							$merseats->status = 1;
							$merseats->save();
						}
					}
					
					$days = array('1'=>'mon','2'=>'tue','3'=>'wed','4'=>'thu','5'=>'fri','6'=>'sat','7'=>'sun');
					for($i=1;$i<=7;$i++){
						$mertimings = new Mertimings;
						$mertimings->merchant_id = $user->id;
						$mertimings->day =$days[$i] ;
						$mertimings->opening_at = '09:00:00';
						$mertimings->closing_at = '19:00:00';
						$mertimings->off = 0;
						$mertimings->status = 1;
						$mertimings->save();
					}
					
					$userdetails = UserDetails::model()->findByAttributes(array('user_id'=>$user->id));
					
					$message = new YiiMailMessage;
					$message->setBody('Welcome '. $userdetails->name .', <br/><br/>
							  You are successfully registered for the SalonChimp.<br/> <br/>
							Enjoy the services of SalonChimp:<br/> <br/>
							  <b>From</b><br/>
							  Team SalonChimp ', 'text/html');
					$message->subject = 'SalonChimp : Welcome';
					$message->to = $user->email;
					$message->from = Yii::app()->user->adminEmail();
					Yii::app()->mail->send($message);
					
					
					$message = new YiiMailMessage;
					$message->setBody('A merchant has been successfully registerd on SalonChimp <br/><br/>
					  Details are:<br/> <br/>
					  Business Name: '.$userdetails->name.'<br />
					  Username: '.$user->username.'<br />
					   Email: '.$user->email.'<br />
					  Contact No.: '.$userdetails->mobile_no.'<br />
					  <b>From</b><br/>
					  Team SalonChimp ', 'text/html');
					$message->subject = 'SalonChimp : A Merchant registered';
					$message->to = 'pareekshyam@gmail.com';
					$message->from = Yii::app()->user->adminEmail();
					Yii::app()->mail->send($message);
					$this->redirect(array('site/login/flag/success'));
				}
			}
		}
		
	}
	
	// data provider for EJuiAutoCompleteFkField for PostCodeId field
	public function actionfindCustomerinfo() {
		$merchant_id = Yii::app()->user->id;
		$q = $_GET['term'];
		if (isset($q)) {
		    $criteria = new CDbCriteria;
		    //condition to find your data, using q as the parameter field
		    $criteria->condition = "merchant_id = '".$merchant_id."' AND name LIKE :custname";
		    //$criteria->addSearchCondition('n', $acc);
		    $criteria->limit = 10; // probably a good idea to limit the results
		    // with trailing wildcard only; probably a good idea for large volumes of data
		    $criteria->params = array(':custname' => trim($q) . '%'); 
		    $customers = Mercustomers::model()->findAll($criteria);
	  
		    if (!empty($customers)) {
			$out = array();
			foreach ($customers as $c) {
			    $out[] = array(
				// expression to give the string for the autoComplete drop-down
				'label' => $c->Customerinfo,  
				'value' => $c->Customerinfo,
				'id' => $c->id, // return value from autocomplete
				
			    );
			}
			echo CJSON::encode($out);
			Yii::app()->end();
		    }
		}
	}
	public function actionSettings()
	{
		$this->layout = 'front_layout';
		//$model = Pages::model()->findByPk(2);
		$this->render('mersettings');
	}
	protected function beforeAction()
	{
		$url = $_SERVER['HTTP_HOST'];
		$url = str_replace('www.','',$url);
		$url = str_replace('http://','',$url);
		$url = str_replace('https://','',$url);
		$url = str_replace('salonchimp.com','',$url);
		$url = str_replace('.','',$url);
		
		if(Yii::app()->user->isMerchant()){
			$record = Users::model()->findByPk(Yii::app()->user->id);
			
			if($record->username == $url){
				return true;
			}
			else{
				Yii::app()->user->logout();
				$this->redirect(Yii::app()->params['siteUrl']);
			}
		
		}
		if(Yii::app()->user->isAdmin()){
			if($url == ''){
				return true;
			}
			else{
				$this->redirect(Yii::app()->params['siteUrl'].'/users/admin');
			}
			
			
			/*$record = Users::model()->findByPk(Yii::app()->user->id);
			$url = $this->createUrl(Yii::app()->request->pathInfo,array('user'=>$record->username));
			$this->redirect($url);
			*/
		}
		else{
			return true;
		}
	}
	
}
