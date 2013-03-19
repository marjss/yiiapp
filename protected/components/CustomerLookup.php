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
        $merchant_id 		= Yii::app()->user->id;
        $customerform 		= new CustomerForm;
        $form 					= new Customerorders;
        $model 				= new Mercustomers;
        $this->performAjaxValidation($customerform);
		  
		  $valid				=	$model->validate();
		  
        if(isset($_POST['ajax']) && $_POST['ajax']==='booking-form')
        {
                echo CActiveForm::validate($customerform);
                Yii::app()->end();
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