<?php 
Yii::import('zii.widgets.CPortlet');
 
class MerchantMenu extends CPortlet
{
    protected function renderContent()
	{
		//echo $homepage; die;
		$this->render('MerchantMenu');
	}
	
}
