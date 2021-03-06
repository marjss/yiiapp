<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" type="text/css" media="screen">
<link rel="stylesheet" id="basename_css-css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/master.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="http://cdn.webrupee.com/font">
<!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
-->
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>

<!--[if lt IE 9]>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" type="text/css" media="screen">
<![endif]-->
</head>
<body>
<header>
    <?php $this->widget('Salonsheader');?>
	 <?php $this->widget('RVMap');?>
	 <?php $this->widget('Contactus');?>
</header>
    <div class="warrper">
	
	<!--<div class="middle-content"> -->
            <?php echo $content; ?>
        <!-- </div> -->
    </div>
<div class="clear"></div>


<footer>
    <?php $this->widget('Footer');?>
</footer>
</body>
</html>
