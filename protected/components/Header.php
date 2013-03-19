<?php 
Yii::import('zii.widgets.CPortlet');
 
class Header extends CPortlet
{
    protected function renderContent()
	{
		//echo $homepage; die;
		$this->render('Header');
	}
	
}
