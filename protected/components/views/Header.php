<?php
	  $actionId =  Yii::app()->controller->action->id;
	  $controller = Yii::app()->controller->id;
	
	  $_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	  $segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
//			echo "<pre>"; print_r($segments); echo '</pre>';
?>

<div class="top-outer"></div>
  <div class="warrper">
    <div class="top">
      <div class="logo">
        <a href="<?php echo Yii::app()->params['siteUrl']; ?>/">
            <?php echo CHtml::image(Yii::app()->baseUrl.'/images/logo.png');?>
        </a>
      </div>
      <div class="top-right">
	<div>
	  <ul>
	    <?php if(Yii::app()->user->isGuest){?>
	    <li class="sign"><?php echo CHtml::link('Signup',Yii::app()->request->baseUrl.'/pricing');?></li>
	    <li class="login"><?php echo CHtml::link('Login',Yii::app()->user->loginUrl);?></li>
	    <li class="call"><a href="mailto:<?php echo Yii::app()->user->adminEmail()?>"><?php echo Yii::app()->user->adminEmail()?></a><?php //echo CHtml::link('+91-91234 91234',Yii::app()->request->baseUrl);?></li>
	
		<?php } else{ ?>
		  <li class="login"><?php echo CHtml::link('Logout',Yii::app()->request->baseUrl.'/site/logout/');?></li>
		  <!--<li class="sign"><?php //echo CHtml::link('Appontment Book',Yii::app()->request->baseUrl.'/users/appointment');?></li>-->
		<?php } ?>
	  </ul>
	</div>
	<div class="manu">
      <ul>
	<?php if(Yii::app()->user->isMerchant()){ ?>
	 <li class="<?php if($actionId == 'appointment'  && $controller == 'users'){echo 'select';}?>"><?php echo CHtml::link('Appointments',Yii::app()->request->baseUrl.'/users/appointment');?></li>
	 <li class="<?php if($actionId == 'admin'  && $controller == 'mercustomers'){echo 'select';}?>"><?php echo CHtml::link('Customers',Yii::app()->request->baseUrl.'/mercustomers/admin');?></li>
	  <li class="<?php if($actionId == 'settings'  && $controller == 'users'){echo 'select';}?>"><?php echo CHtml::link('Settings',Yii::app()->request->baseUrl.'/users/settings');?></li>
	
	  <!-- <li class="<?php //if($actionId == 'admin'  && $controller == 'merholidays'){echo 'select';}?>"><?php //echo CHtml::link('Holidays',Yii::app()->request->baseUrl.'/merholidays/admin');?></li>
	     <li class="<?php //if($actionId == 'admin'  && $controller == 'merseats'){echo 'select';}?>"><?php //echo CHtml::link('Seats',Yii::app()->request->baseUrl.'/merseats/admin');?></li>
	  <li class="<?php //if($actionId == 'admin'  && $controller == 'merservices'){echo 'select';}?>"><?php //echo CHtml::link('Services',Yii::app()->request->baseUrl.'/merservices/admin');?></li>
	   <li class="<?php //if($actionId == 'admin'  && $controller == 'mertimings'){echo 'select';}?>"><?php //echo CHtml::link('Timings',Yii::app()->request->baseUrl.'/mertimings/admin');?></li>
	   -->
	<?php } else { ?>
        <li class="<?php if($actionId == 'index'  && $controller == 'site'){echo 'select';}?>"><?php echo CHtml::link('Home',Yii::app()->request->baseUrl.'/');?></li>
        <li class="<?php if($actionId == 'features'  && $controller == 'site'){echo 'select';}?>"><?php echo CHtml::link('Features',Yii::app()->request->baseUrl.'/features');?></li>
        <li class="<?php if($actionId == 'pricing'  && $controller == 'site'){echo 'select';}?>"><?php echo CHtml::link('Pricing',Yii::app()->request->baseUrl.'/pricing');?></li>
        <li class="<?php if($actionId == 'about'  && $controller == 'site'){echo 'select';}?>"><?php echo CHtml::link('About us',Yii::app()->request->baseUrl.'/about');?></li>
	<!--<li class="<?php //if($actionId == 'terms'  && $controller == 'site'){echo 'select';}?>"><?php //echo CHtml::link('Terms',Yii::app()->request->baseUrl.'/site/terms');?></li>
	<li class="<?php //if($actionId == 'privacy'  && $controller == 'site'){echo 'select';}?>"><?php //echo CHtml::link('Privacy Policy',Yii::app()->request->baseUrl.'/site/privacy');?></li>
	-->
	<?php } ?>
      </ul>
    </div>
      </div>
       <div class="clear"></div>
	</div>
      
    <div class="top-manu">
    
      
    </div>
</div>