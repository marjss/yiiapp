<?php
Yii::import('zii.widgets.CPortlet');



class DeemAdminMenu extends CPortlet {
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
				array('label'=>'Users', 'items' => array(
						array('label'=> 'Users List', 'url'=>array('//users/admin') ),
						array('label'=> 'Create New', 'url'=>array('//users/create'),'itemOptions'=>array('class'=>'last')),
						)
					),
				array('label'=>'Services', 'items' => array(
						array('label'=> 'Manage', 'url'=>array('//services/admin') ),
						array('label'=> 'Create New', 'url'=>array('//services/create'),'itemOptions'=>array('class'=>'last')),  
						)
					),
				
				array('label'=>'Pricing Plans', 'items' => array(
						array('label'=> 'Manage', 'url'=>array('//pricingplans/admin') ),
						array('label'=> 'Create New', 'url'=>array('//pricingplans/create'),'itemOptions'=>array('class'=>'last')),  
						)
					),
				array('label'=>'Pages', 'items' => array(
						array('label'=> 'Manage', 'url'=>array('//pages/admin') ),
						array('label'=> 'Create New', 'url'=>array('//pages/create'),'itemOptions'=>array('class'=>'last')),  
						)
					),
				array('label'=>'Settings', 'items' => array(
						array('label'=> 'Manage', 'url'=>array('//settings/admin') ),
						array('label'=> 'Create New', 'url'=>array('//settings/create'),'itemOptions'=>array('class'=>'last')),  
						)
					),
//				array('label'=>'Category Service', 'items' => array(
//						array('label'=> 'Manage', 'url'=>array('//categoryservice/admin') ),
//						array('label'=> 'Create New', 'url'=>array('//categoryservice/create'),'itemOptions'=>array('class'=>'last')),  
//						)
//					),
				
				
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






