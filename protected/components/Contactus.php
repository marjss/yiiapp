<?php

Yii::import('zii.widgets.CPortlet');

class Contactus extends CPortlet {

	public $PageId;
	public function getPagecontent()
	{
		
		return Pages::model()->findByPk($this->PageId);
	}
	
	protected function renderContent()
	{
         
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{ 
				  echo CActiveForm::validate($customerform);
				  Yii::app()->end();
		}
		$this->render('Contactus',array('model'=>$model));
	}
}