<?php
	  $actionId 	=  Yii::app()->controller->action->id;
	  $controller 	= 	Yii::app()->controller->id;
	
	  $_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	  $segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
			//echo "<pre>"; print_r($segments); die;
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
					 <a href="<?php echo Yii::app()->baseUrl.'/site/index';?>">
						  <div class="trysalonchimp">
								 <div class="inner"></div>
								 <span class="trysalon-text">SalonChimp For Salon</span>
						  </div>
					 </a>
			  </div>
			  <div class="clear"></div>
			</div>
		</div>