<?php
Yii::import('zii.widgets.CPortlet');
class AppointmentSelectbox extends CPortlet {

	 public $PageId;
         
    public function getMerchantServices($merchantid,$cat_id)
    {
       
      $criteria=array('condition'=>'merchant_id='.$merchantid.' AND cat_id='.$cat_id. ' AND status=1 AND isproduct=0','order'=>'t.name ASC');
      return Merservices::model()->findAll($criteria);
    }
    public function getServices($id){
            $merservices = new Merservices;
            $merchant_services = $merservices->getAllMerchantServices();
                return CJSON::encode($merchant_services);
        }
        
    public function getCategoryService()
    {
         return CategoryService::model()->findAllByAttributes(array('status'=>1));
    }
    public function getMerchantTiming($merchantid)
    {
         return Mertimings::model()->findByAttributes(array('merchant_id'=>$merchantid));
    }

	protected function renderContent()
	{
                $model = Merservices::model()->findByPk($this->PageId);
		$this->render('AppointmentSelectbox',array('model'=>$model));
	}
}
?>
