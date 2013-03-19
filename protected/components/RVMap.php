<?php
Yii::import('zii.widgets.CPortlet');

class RVMap extends CPortlet {

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
		//$model	=	UserDetails::model()->findByAttributes(array('user_id'=>34));
		$model	=	new UserDetails;
		$this->render('RVMap',array('model'=>$model));
	}
}
?>