<!DOCTYPE HTML>
<html lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>salonier</title>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/landing.css" media="screen, projection" />
        <link rel="stylesheet" id="basename_css-css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/master.css" type="text/css" media="all">
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" type="text/css" media="screen">
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>

        <!--[if lt IE 9]>
                <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5.js"></script>
                <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" type="text/css" media="screen">
        <![endif]-->
         <?php // $this->widget('Header'); ?>
             <?php $this->widget('Reviews');?>
	  <?php $this->widget('RVMap');?>
	 <?php $this->widget('Shopcontact');?>
       
    </head>
    <body>

        <div class="top-outer"> </div>
        <div class="warrper">
            <?php echo $content?>
        </div>
    

    <footer>
        <?php $this->widget('Footer'); ?>
    </footer>
</body>
</html>

