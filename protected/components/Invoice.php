<?php 
class Invoice extends CWidget
{
    public $title='Invoice';
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
        $merchant_id 		= Yii::app()->user->id;
        $item = Customerorders::model()->findAllByAttributes(array('merchant_id'=>$merchant_id));
//        echo '<pre>';
//        print_r($item);
//        echo '</pre>';
//        $order = Orderdetails::model()->findByAttributes($attributes);
        
        $this->render('Invoice',array());
    }
    
   /* protected function performAjaxValidation($form)
    {
            if(isset($_POST['ajax']) && $_POST['ajax']==='booking-form')
            {
                    echo CActiveForm::validate($form);
                    Yii::app()->end();
            }
    }*/
}
?>