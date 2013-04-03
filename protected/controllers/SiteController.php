<?php

class SiteController extends Controller
{
	
	public $defaultAction = 'salons';

	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//echo "<pre>"; print_r($_SERVER['HTTP_REFERER']); die;
		$userid = Yii::app()->user->id;
		if($userid && $_SERVER['HTTP_REFERER'] == null){
			$record=Users::model()->findByPk($userid);
			$this->redirect(array('/users/appointment','user'=>$record->username));
		}
		
		$url = $_SERVER['HTTP_HOST'];
                
		if($url == 'localhost' || $url == '127.0.0.1' || $url == '192.168.1.56' || $url == 'sudhanshu.stuffuneedlocal.com '){
			$url = '';
		}
		else{
			$url = str_replace('www.','',$url);
			$url = str_replace('http://','',$url);
			$url = str_replace('https://','',$url);
			$url = str_replace('stuffuneedlocal.com','',$url);
			$url = str_replace('.','',$url);
//			echo $url; die;
		}
		
	
		if($url == ''){
			$this->layout = "home_layout";
			$this->pageTitle=Yii::app()->name . ' - Online appointment system for salons by SalonChimp';
			$this->render('index');
		}
		else{
			$crit = new CDbCriteria;
			$crit->condition = "status = 1";
			$users = Users::model()->findAll($crit);
			$merchantinfor = array();
			$flag = 0;
			foreach($users as $val){
				if($val->username == $url){
					$flag = 1;
					$details = UserDetails::model()->findByAttributes(array('user_id'=>$val->id));
					$merchantinfor['name'] = $details->name;
					$merchantinfor['mobile_no'] = $details->mobile_no;
					$merchantinfor['city'] = $details->city;
				}
			}
			
			if($flag == 1)
			{
				$this->layout = "front_layout";
				$this->pageTitle=Yii::app()->name . ' - Online appointment system for salons by SalonChimp';
				$this->render('welcome',array('merinfo'=>$merchantinfor));
			}
			else{
				$this->redirect(Yii::app()->params['siteUrl']);
			}
		}
		
		
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$this->layout = "blank";
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$url = $_SERVER['HTTP_HOST'];
		$url = explode('.',$url);
                //print_r($url);
		$crit = new CDbCriteria;
		$crit->condition = "status = 1";
		$users = Users::model()->findAll($crit);
                $userid = Yii::app()->user->id;
		if($userid){
                    
			$record=Users::model()->findByPk($userid);
			$this->redirect(array('/users/appointment','user'=>$record->username));
		}
		$model=new LoginForm;
		//$user= Users::model()->findByPk(1);
		//print_r($user->attributes); die;
		
		$this->layout = "front_layout";
		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
//			echo "<pre>"; print_r($model->attributes); die;
			//var_dump($model->validate()); die;
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				$user_id = Yii::app()->user->id;
				$record=Users::model()->findByPk($user_id);
                               
				if($record->masrole->name == 'Admin')
                                   // echo'<pre>'; print_r($record->username);die;
					$this->redirect(array('//users/admin'));
				if($record->masrole->name == 'Merchant'){
                                    
					
//                                        $this->redirect(array('/users/appointment','user'=>$record->username));
					$this->redirect(array('//users/settings','user'=>$record->username));
					//$this->redirect(array('//users/appointment'));
				}
				
			}
		}
		if($_GET['flag'] == 'success'){
			Yii::app()->user->setFlash('acc_active','Your account is now active, login with your username and password.');
		}
		if(isset($_GET['change']) ){
			if($_GET['change']==1)
				Yii::app()->user->setFlash('forgotpass','Your password has been sent to you by email.');
			
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		//echo Yii::app()->siteUrl; die;
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->params['siteUrl']);
	}
	
	public function actionPricing()
	{
		$this->layout = "front_layout";
		$dataProvider = new CActiveDataProvider('Pricingplans');
		$this->render('pricingplans',array('dataProvider'=>$dataProvider));
	}
	
	public function actionAbout()
	{
		$this->layout = "front_layout";
		$this->render('about');
	}
	public function actionFeatures()
	{
		$this->layout = "front_layout";
		
		$this->render('features');
	}
	public function actionTerms()
	{
		$this->layout = 'front_layout';
		$model = Pages::model()->findByPk(1);
		$this->render('terms',array('model'=>$model));
	}
	public function actionPrivacy()
	{
		$this->layout = 'front_layout';
		$model = Pages::model()->findByPk(2);
		$this->render('privacy',array('model'=>$model));
	}
	
	public function actionSalons()
	{
		$this->layout 	=   'salons';
                /*
                $crit = new CDbCriteria;
		$crit->condition = "status = 1";
		$users = Users::model()->findAll($crit);
                $userid = Yii::app()->user->id;
		if($userid){
                    
			$record=Users::model()->findByPk($userid);
			$this->redirect(array('/users/appointment','user'=>$record->username));
		}*/
                $model  =   new Users;
		$this->render('salons', array('model'=>$model));
	}
	
	public function actionSearchsalon()
	{
            
		
		$this->layout = 'salons';
               
		if($_POST)
		{
                   
			$service_name = $_POST['name'];
			$service_nearby = $_POST['nearby'];
                        Yii::app()->session['city'] = $_POST['Merservices']['city'];
                        
                        $cityy= Yii::app()->session['city'];
			$model = new Merservices;
                        $cats = new CategoryService;
			$this->render('searchsalon', array('model'=>$model,'city'=>$cityy,'category'=>$cats));
		}
		else
		{
                    Yii::app()->session['city'] = $_POST['Merservices']['city'];
                    
                        $cityy= Yii::app()->session['city'];
			$model = new Merservices;
			$this->render('searchsalon', array('model'=>$model,'city'=>$cityy));
		}
		
	}
	
	public function actionGmap()
	{
		$id 						= 	$_POST['merchant_id'];
		$this->layout 			= 	'blankjson';
		$model 					=  UserDetails::model()->findByAttributes(array('user_id'=>$id));
		$city 					= 	$model->city;
		$model_city 			=  Citylist::model()->findByAttributes(array('city_name'=>$city));
		
		$lat						=	explode(" " ,$model_city->latitude);
		$long						=	explode(" " ,$model_city->longitude);
		
		$data['success'] 		= 'Success';
		$data['lat'] 			= 	$lat[0];
		$data['long'] 			= 	$long[0];
		$data['saloonname']             = 	$model->name;
		$data['address']		=	$model->address;
		$data['state']			=	$model_city->state;
		$data['city']			=	$model->city;
		
		echo CJavaScript::jsonEncode($data);
			Yii::app()->end();
		//$this->render('map' , array('model'=>$model));
	}
        /**
         * Function for Shop details 
         */
	public function actionDetails($id){
            $this->layout = 'chimps';
            $services= Merservices::model()->findAllByattributes(array('merchant_id'=>$id,'status'=>1));
            $users = Users::model()->findByPk($id);
            $time = Mertimings::model()->findAllByAttributes(array('merchant_id'=>$id));
            $gallery= Gallery::model()->findAllByAttributes(array('user_id'=>$id));
            $deals= Deals::model()->findAllByAttributes(array('merchant_id'=>$id));
            $review = Review::model()->findAllByAttributes(array('merchant_id'=>$id));
            $categoryservice = CategoryService::model()->findAll();
//             if( Yii::app()->request->isAjaxRequest )
                        
                 
            $model = UserDetails::model()->findByAttributes(array('user_id' => $id));
            
//             Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
//             Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
            $this->render('shops',array('model'=>$model,'users'=>$users ,'services'=>$services,'time'=> $time,'gallery'=>$gallery,'deals'=>$deals,'categoryservice'=>$categoryservice,'review'=>$review));
                        
        }
        public function getMerchantServices($merchantid,$cat_id)
    {
       
      $criteria=array('condition'=>'merchant_id='.$merchantid.' AND cat_id='.$cat_id.' AND status =1','order'=>'t.name ASC');
      return Merservices::model()->findAll($criteria);
    }
	public function actionAjaxRequestAppointment()
	{
            
			  if (isset($_POST['ContactForm'])){
					//$post  = $this->loadModel();
					$requestapp = new RequestAppointment;
					$requestapp->setAttributes($_POST['ContactForm']);
					$error = CActiveForm::validate($requestapp, array('name','email','mobileno', 'body','date'));
					
					if($error=='[]'){
						$merchant_id = $_POST['merchant'];
						$merchant_model = Users::model()->findByPk($merchant_id);
						$message 					= new YiiMailMessage;
							$model_emailtemplate=Emailtemplate::model()->findByPk(1);
							$body   =	$model_emailtemplate->body;
							$body	=	str_replace('$CustomerName', $merchant_model->username, $body);
							$create_body	='
																 <div>'.$requestapp->name.' has Requested for Appointment.</div>
																 <br />
																 <div>Here are the details: </div>
                                                                                                                                 <div>Appointment On: '.$requestapp->date.' </div>
																 <div>Mobile No: '.$requestapp->mobileno.'</div>
																 <div>Email: '.$requestapp->email.' </div>
																 <div>Message: '.$requestapp->body.' </div>
																 <br />
																 
																 ';
							$body							=	str_replace('$body', $create_body, $body);
							$body							=	str_replace('$SalonName', $customerdetail->name, $body);
							$message->setBody($body, 'text/html');
							$message->subject 			= $requestapp->subject;
							$message->to 				=  $merchant_model->email;
							$message->from				= 	$requestapp->email;
							if(Yii::app()->mail->send($message))
							{
							  echo 'sent';die;
							}else{
									 echo 'fail';die;
							}
					}else{
						 echo $error;
					}
			  }else{
					//$this->redirect(array("site/index"));
			  }
	}
	
	/*protected function afterAction()
	{
		if(Yii::app()->user->id){
			$record = Users::model()->findByPk(Yii::app()->user->id);
			$this->redirect(array(Yii::app()->request->pathInfo,'user'=>$record->username));
		}
	}
	*/
        /**
         * Function for submitting the review from the Shop page
         */
       public function actionReviewsub($id){
           if (isset($_POST['Review'])){
               $model = new Review;
               $model->setAttributes($_POST['Review']);
					$error = CActiveForm::validate($model, array('name','email','review',));
//					
					if($error=='[]'){
                                             $timezone = "Asia/Calcutta";
                                            date_default_timezone_set($timezone);
                                            $time= mktime();
//                                          echo $time;
                                            $model->setAttribute('date', $time);
                                             $model->setAttribute('status',1);
//                                         print_r($model->attributes);die;
                                           if($model->save()){
							  echo 'sent';die;
							}else{
									 echo 'fail';die;
							}  
                                            
                                        }else{
						 echo $error;
					}
           }
       }
}