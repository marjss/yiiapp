<?php 
Yii::import('zii.widgets.CPortlet');
 
class Salonsheader extends CPortlet
{
    protected function renderContent()
	{
		//echo $homepage; die;
		$this->render('Salonsheader');
	}
	
}
