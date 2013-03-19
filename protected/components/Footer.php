<?php 
Yii::import('zii.widgets.CPortlet');
 
class Footer extends CPortlet
{
    protected function renderContent()
	{
		//echo $homepage; die;
		$this->render('Footer');
	}
	
}
