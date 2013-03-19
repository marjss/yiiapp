<?php
Yii::import('zii.widgets.CPortlet');
class AppointmentSelectbox extends CPortlet {

	 public $PageId;
    
    public function getMerchantServices($merchantid,$cat_id)
    {
      $criteria=array('condition'=>'merchant_id='.$merchantid.' AND cat_id='.$cat_id,'order'=>'t.name ASC');
      return Merservices::model()->findAll($criteria);
    }
    
    public function getCategoryService()
    {
         return CategoryService::model()->findAll();
    }

	protected function renderContent()
	{
//            echo  $this->PageId;
		$model = Merservices::model()->findByPk($this->PageId);
                
		$this->render('AppointmentSelectbox',array('model'=>$model));
	}
}
?>