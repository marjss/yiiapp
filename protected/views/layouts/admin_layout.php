<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<link rel="shortcut icon" href="<?php //echo Yii::app()->request->baseUrl; ?>/favicon.ico">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin_style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
   <div id="header">
	<div><?php
        echo CHtml::link('',array('users/admin'),array('id'=>'logo')); ?></div>
	<div class='header-right'>
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout/'), 'visible'=>!Yii::app()->user->isGuest),
			),
			'lastItemCssClass'=> 'menuright',
			
		)); ?>
	</div>
	<div class='clear'></div>
	<div class="administrationpanel">
		<div class="administratorpanel-left">
			<?php if(Yii::app()->user->isAdmin()) { 
				echo "Administrator Panel";
			}
			elseif(Yii::app()->user->isMerchant()) {
				echo "Merchant Control Panel";
			}
			?>
		</div>
		<div class="administratorpanel-right">
			<span><strong>Server Time : </strong></span><span id="timing-grid"><?php echo date("Y-m-d, G:i:s"); ?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span><strong>IP : </strong><?php echo $_SERVER['SERVER_ADDR']?></span>
		</div>
		<div class="cl"></div>
	</div>
   </div><!-- header -->
   <div class="wrap">
	<div class="span-5 last">
	     <div id="sidebar">
		     <?php                      
                     if(Yii::app()->user->isAdmin()) {$this->widget('DeemAdminMenu');} elseif(Yii::app()->user->isMerchant()) {  $this->widget('DeemMerchantMenu');}	?>
	     </div><!-- sidebar -->
	</div>
	<div class="span-25">
	     <div id="content">
		     <?php echo $content; ?>
	     </div><!-- content -->
	</div>
	<div class="clear"></div>
   </div>
   <div id="footer">
   </div><!-- footer -->
</div><!-- page -->

</body>
</html>
