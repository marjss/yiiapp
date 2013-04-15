<?php

Yii::import('zii.widgets.CPortlet');

class Shopcontact extends CPortlet {

	public $PageId;
	public function getPagecontent()
	{
		
		return Pages::model()->findByPk($this->PageId);
	}
	
	protected function renderContent()
	{
                $merchant_id = $_GET['id'];
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{ 
                    
				  echo CActiveForm::validate($customerform);
				  Yii::app()->end();
		}
		$this->render('Shopcontact',array('model'=>$model, 'merchant'=>$merchant_id));
	}
}