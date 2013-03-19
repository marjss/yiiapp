<?php
Yii::import('zii.widgets.CPortlet');



class DeemMerchantMenu extends CPortlet {
	public function init() {
		$this->title = Deem::t('');
		 
		$this->contentCssClass = 'menucontent';
		return parent::init();
		
	}

	public function run() {
		$this->widget('DeemMenu', array(
					'items' => $this->getMenuItems()
					));

		parent::run();
	}

	public function getMenuItems() { 
		
		return array( 
				/*array('label'=>'Home', 'url' => array('//admin/dashboard'),'itemOptions'=>array('class'=>'adminhome')),
				array('label'=>'Sites', 'items' => array(
						array('label'=> 'Approved Sites', 'url'=>array('//admin/approvedsites') ),
						array('label'=> 'Running', 'url'=>array('//admin/runningsites'),'itemOptions'=>array('class'=>'last') ),
						)
					),
				/*array('label'=>'Members', 'items' => array(
						array('label'=> 'Members', 'url'=>array('//admin/member'),'itemOptions'=>array('class'=>'last') ),
						)
					),
				
				
				*/
				/*array('label'=>'Users', 'items' => array(
						array('label'=> 'Users List', 'url'=>array('//merchant/admin') ),
						array('label'=> 'Create New', 'url'=>array('//merchant/create'),'itemOptions'=>array('class'=>'last')),
						)
					),
                                */
				array('label'=>'Services', 'items' => array(
						array('label'=> 'Manage', 'url'=>array('//merservices/admin') ),
						array('label'=> 'Create New', 'url'=>array('//merservices/create'),'itemOptions'=>array('class'=>'last')),  
						)
					),
				
				
				array('label'=>'Seats', 'items' => array(
						array('label'=> 'Manage', 'url'=>array('//merseats/admin') ),
						array('label'=> 'Create New', 'url'=>array('//merseats/create'),'itemOptions'=>array('class'=>'last')),  
						)
					),
				array('label'=>'Timings', 'items' => array(
						array('label'=> 'Manage', 'url'=>array('//mertimings/admin') ),
						//array('label'=> 'Create New', 'url'=>array('//mertimings/create'),'itemOptions'=>array('class'=>'last')),  
						)
					),
				array('label'=>'Holidays', 'items' => array(
						array('label'=> 'Manage', 'url'=>array('//merholidays/admin') ),
						array('label'=> 'Create New', 'url'=>array('//merholidays/create'),'itemOptions'=>array('class'=>'last')),  
						)
					),
                        
				/*array('label'=>'Set Up', 'items' => array(
						array('label'=> 'Users', 'url'=>array('//user/admin')),
						array('label'=> 'Localization', 'url'=>array('//localization/admin')),
						array('label'=> 'Subscriptions', 'url'=>array('//subscriptions/admin')),
						array('label'=> 'Tooltips', 'url'=>array('//tooltip/admin')),
						array('label'=> 'Email Templates', 'url'=>array('//SimpleMailer/template/admin')),
						array('label'=> 'Create New', 'url'=>array('//SimpleMailer/template/create'),'itemOptions'=>array('class'=>'last')),
						)
					),
				*/
				
				
				);
	}
}
?>






