<?php 
Yii::import('zii.widgets.CPortlet');
 
class Salonssearch extends CPortlet
{
    protected function renderContent()
	{
		  $model    = new	Merservices;
                  $users = new UserDetails;
                  $city=  Yii::app()->session['city'];
                
		$this->render('Salonssearch', array('model'=>$model,'users'=>$users,'city'=>$city));
	}
	
}
