<?php
$this->breadcrumbs=array(
	'Settings',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));
$this->pageTitle = 'Salon Chimp - Settings';
?>
<div class="merchantpanel">
    <h1>Settings</h1>
  <div class="mersettingup">
   <?php echo CHtml::link('<div class="merchantholday"><h2>Holidays</h2></div>',Yii::app()->request->baseUrl.'/merholidays/admin');?>
   <?php echo CHtml::link('<div class="merchantholday"><h2>Stylists</h2></div>',Yii::app()->request->baseUrl.'/merseats/admin');?>
   <?php echo CHtml::link('<div class="merchantholday"><h2>Services/Products</h2></div>',Yii::app()->request->baseUrl.'/merservices/admin');?>
  </div>
  <div class="clear"></div>
  <div class="mersettingup">
    <?php echo CHtml::link('<div class="merchantholday"><h2>Timings</h2></div>',Yii::app()->request->baseUrl.'/mertimings/admin');?>
    <?php echo CHtml::link('<div class="merchantholday"><h2>Change Password</h2></div>',Yii::app()->request->baseUrl.'/users/changepassword');?>
    <?php echo CHtml::link('<div class="merchantholday"><h2>Offers</h2></div>',Yii::app()->request->baseUrl.'/deals/admin');?>
</div>
     <div class="clear"></div>
    <div class="mersettingup">
    <?php echo CHtml::link('<div class="merchantholday"><h2>About us</h2></div>',Yii::app()->request->baseUrl.'/users/description');?>
    <?php echo CHtml::link('<div class="merchantholday"><h2>Profile</h2></div>',Yii::app()->request->baseUrl.'/users/account');?>    
    <?php echo CHtml::link('<div class="merchantholday"><h2>Gallery</h2></div>',Yii::app()->request->baseUrl.'/gallery/admin');?>
    <div class="clear"></div>  
</div>
     <div class="mersettingup">
    <?php echo CHtml::link('<div class="merchantholday"><h2>Reviews</h2></div>',Yii::app()->request->baseUrl.'/review/reviews');?>
    <?php// echo CHtml::link('<div class="merchantholday"><h2>Profile</h2></div>',Yii::app()->request->baseUrl.'/users/account');?>    
    <?php// echo CHtml::link('<div class="merchantholday"><h2>Gallery</h2></div>',Yii::app()->request->baseUrl.'/gallery/admin');?>
    <div class="clear"></div>  
</div>
     
    
</div>  
</div>
