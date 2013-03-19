<?php 
class UpdateOrder extends CWidget
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
       
        $model = new Mercustomers;
        $form = new Customerorders;
      
        if($_POST){
            $form->changeUpdateStatus($_POST['lastupdate_order']);
            $services =$_POST['update_services'];
            $x = explode(',',$services);
            $y = "'".implode("','", $x)."'"; 
            
            $form->appointment_date_time = date('Y-m-d H:i:s',$_POST['updatestime']);
            $form->merchant_seat_id = $_POST['seat_id'];
            $form->merchant_id = $merchant_id;
            $form->status = 1;
            if($_POST['sms']){
                $form->send_sms = 1;
            }
            if($_POST['email']){
                $form->send_email = 1;
            }
            
            $customer = Mercustomers::model()->findByPk($_POST['upcustomer_id']);
            $form->customer_id = $customer->id;
            $form->customer_name = $customer->name;
            $form->customer_contact_no = $customer->mobile_no;
            $form->customer_email = $customer->email;
            $form->customer_address = $customer->city;
     
           
            if($form->save()){
                if($form->send_sms == 1){
                    $message1 = 'Your appointment with Style & Scissors for '.date('d/m/Y',strtotime($form->appointment_date_time)).' has been confirmed.<br>
                        Slot: '.date('h:i A',$_POST['updatestime']).'-'.date('h:i A',$_POST['updateendtime']).'.
                        Stylist: '.$form->seat->name.'. Thank you.';
                    $model->sendSms($form->customer_contact_no,$message1);
                }
                if($form->send_email == 1){
                    $message = new YiiMailMessage;
                    $message->setBody('Your appointment with Style & Scissors for '.date('d/m/Y',strtotime($form->appointment_date_time)).' has been confirmed.<br>
                        Slot: '.date('h:i A',$_POST['updatestime']).'-'.date('h:i A',$_POST['updateendtime']).'.
                        Stylist: '.$form->seat->name.'. Thank you.
                      <b>From</b><br/>
                      Team SalonChimp', 'text/html');
                    $message->subject = 'SalonChimp : Appointment';
                    $message->to =  $form->customer_email;
                    $message->from = Yii::app()->params['adminEmail'];
                    Yii::app()->mail->send($message);
                }
                
               
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
        $this->render('UpdateOrder');
    }
    
    
}
?>