<?php 
class Reviews extends CWidget
{
    public $title='Review';
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
            $merchant_id = $_GET['id'];
            $this->renderContent($merchant_id);
        }
    }
 
    protected function renderContent($merchant_id)
    {
       
        $model 	=  new Review;
        $this->performAjaxValidation($model);
	$valid	= $model->validate();
		  
        if(isset($_POST['ajax']) && $_POST['ajax']==='review-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }
        $this->render('Reviews',array('model'=>$model,'merchant_id'=>$merchant_id));
    }
    
    protected function performAjaxValidation($model)
    {
            if(isset($_POST['ajax']) && $_POST['ajax']==='review-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    }
}
?>