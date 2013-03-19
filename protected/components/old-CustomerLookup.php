<?php 
class CustomerLookup extends CWidget
{
    public $title='Customer Lookup';
    public $visible=true; 
 
    public function init()
    {
        if($this->visible)
        {
 
        }
    }
 
    public function run()
    {
        if($this->visible)
        {
            $this->renderContent();
        }
    }
 
    protected function renderContent()
    {
        //
        $merchant_id = Yii::app()->user->id;
        $customerform = new CustomerForm;
        $form = new Customerorders;
       
        $model = new Mercustomers;
        
        $this->performAjaxValidation($customerform);
	$valid=$model->validate(); 	
        if(isset($_POST['ajax']) && $_POST['ajax']==='booking-form')
        {
                echo CActiveForm::validate($customerform);
                Yii::app()->end();
        }
        
        if($_POST){ 
            $form->attributes = $_POST['Customerorders'];
            $form->appointment_date_time = date('Y-m-d H:i:s',$_POST['starttime']);
            $form->merchant_seat_id = $_POST['seatid'];
            $form->merchant_id = $merchant_id;
            $form->status = 1;
            if($_POST['sms']){
                $form->send_sms = 1;
            }
            if($_POST['email']){
                $form->send_email = 1;
            }
            if($_POST['customerid']){
                $customer = Mercustomers::model()->findByPk($_POST['customerid']);
                $form->customer_id = $customer->id;
                $form->customer_name = $customer->name;
                $form->customer_contact_no = $customer->mobile_no;
                $form->customer_email = $customer->email;
                $form->customer_address = $customer->city;
            }
            else
            {
                
                $customer = new Mercustomers;
                $customer->merchant_id = Yii::app()->user->id;
                $customer->name = $_POST['CustomerForm']['customer_name'];
                $customer->mobile_no = $_POST['CustomerForm']['customer_contact_no'];
                $customer->email = $_POST['CustomerForm']['customer_email'];
                //$customer->city = $_POST['Customerorders']['customer_contact_no'];
                
                if($customer->save()){
                    $form->customer_id = $customer->id;
                    $form->customer_name = $customer->name;
                    $form->customer_contact_no = $customer->mobile_no;
                    $form->customer_email = $customer->email;
                    $form->save();
                }
            }
            if($form->save()){
                if($form->send_sms == 1){
                    $message1 = 'Your appointment with Style & Scissors for '.date('d/m/Y',strtotime($form->appointment_date_time)).' has been confirmed.<br>
                        Slot: '.date('h:i A',$_POST['starttime']).'-'.date('h:i A',$_POST['endtime']).'.
                        Stylist: '.$form->seat->name.'. Thank you.';
                    $model->sendSms($form->customer_contact_no,$message1);
                }
                if($form->send_email == 1){
                    $usercustomer				=	Users::model()->findByPk(Yii::app()->user->id);
						  $customerdetail				=	UserDetails::model()->findByAttributes(
																		  array('user_id'=>Yii::app()->user->id)
																);
																					 $message 					= new YiiMailMessage;
						  $model_emailtemplate		=	Emailtemplate::model()->findByPk(1);
						  $body							=	$model_emailtemplate->body;
						  $body							=	str_replace('$CustomerName', $customer->name, $body);
						  $create_body					=	'
																<div>Your appointment with '.$customerdetail->name.' has been confirmed.</div>
																<br />
																<div>Here are the details: </div>
																<div>Date: '.date('Y-m-d',$_POST['starttime']).'</div>
																<div>Time: '.date('h:i A',$_POST['starttime']).'-'.date('h:i A',$_POST['endtime']).' </div>
																<div>Stylist: '.$form->seat->name.' </div>
																<br />
																<div>For any further assistance, please reply to this email or call us at '.$customerdetail->mobile_no.'.</div>
																';
						  $body							=	str_replace('$body', $create_body, $body);
						  $body							=	str_replace('$SalonName', $customerdetail->name, $body);
                    $message->setBody($body, 'text/html');
                    $message->subject 			= 'Appointment confirmed with '.$customerdetail->name;
                    $message->to 				=  $form->customer_email;
                    $message->from				= 	$usercustomer->email;
                    Yii::app()->mail->send($message);
                }
                
                $services =$_POST['slctd_services'];
                $x = explode(',',$services);
                $y = "'" . implode("','", $x) . "'"; 
                $crit = new CDbCriteria;
                $crit->condition = "id IN (".$y.") AND merchant_id = '".$merchant_id."' AND status = 1";
                $cust_services = Merservices::model()->findAll($crit);
                foreach($cust_services as $cs){
                    $orderdetail = new Orderdetails;
                    $orderdetail->customer_order_id = $form->id;
		    $orderdetail->service_id = $cs->id;
                    $orderdetail->service_name = $cs->name;
                    $orderdetail->service_price = $cs->price;
                    $orderdetail->service_duration = $cs->duration;
                    $orderdetail->save();
                }
            }
        }
        $this->render('CustomerLookup',array('form'=>$form,'model'=>$model,'customerform'=>$customerform));
    }
    
    protected function performAjaxValidation($form)
    {
            if(isset($_POST['ajax']) && $_POST['ajax']==='booking-form')
            {
                    echo CActiveForm::validate($form);
                    Yii::app()->end();
            }
    }
}
?>