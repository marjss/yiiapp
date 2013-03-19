<?php
$this->breadcrumbs=array(
	'Settings',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));
?>
<div class="merchantpanel">
    <h1>Settings</h1>
  <div class="mersettingup">
    <?php echo CHtml::link('<div class="merchantholday"><h2>Holidays</h2></div>',Yii::app()->request->baseUrl.'/merholidays/admin');?>
   <?php echo CHtml::link('<div class="merchantseats"><h2>Stylists</h2></div>',Yii::app()->request->baseUrl.'/merseats/admin');?>
    
    
</div>
  <div class="clear"></div>
  <div class="mersettingup">
     <?php echo CHtml::link('<div class="merchantholday"><h2>Services</h2></div>',Yii::app()->request->baseUrl.'/merservices/admin');?>
    
    <?php echo CHtml::link('<div class="merchantseats"><h2>Timings</h2></div>',Yii::app()->request->baseUrl.'/mertimings/admin');?>
</div>
    <div class="clear"></div>
     <div class="mersettingup">
    <?php echo CHtml::link('<div class="merchantholday"><h2>Change Password</h2></div>',Yii::app()->request->baseUrl.'/users/changepassword');?>
   <?php echo CHtml::link('<div class="merchantseats"><h2>Offers</h2></div>',Yii::app()->request->baseUrl.'/deals/admin');?>
</div>
     <div class="clear"></div>
    <div class="mersettingup">
    <?php echo CHtml::link('<div class="merchantholday"><h2>Description</h2></div>',Yii::app()->request->baseUrl.'/users/description');?>
    <?php echo CHtml::link('<div class="merchantseats"><h2>Account</h2></div>',Yii::app()->request->baseUrl.'/users/account');?>    
      <div class="clear"></div>  
</div>
      <div class="mersettingup">
    <?php echo CHtml::link('<div class="merchantholday"><h2>Gallery</h2></div>',Yii::app()->request->baseUrl.'/gallery/admin');?>
    
      <div class="clear"></div>  
</div>  
</div>
