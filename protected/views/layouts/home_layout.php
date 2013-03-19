<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" type="text/css" media="screen">
<link rel="stylesheet" id="basename_css-css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/master.css" type="text/css" media="all">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>

<!--[if lt IE 9]>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" type="text/css" media="screen">
<![endif]-->
</head>
<body>
<header>
    <?php $this->widget('Header');?>
</header>
<section>
    <div class="warrper">
        <div class="mid-part">
            <div class="mid-part-left">
                <div class="mid-left-cont">
                    <h2>Easy online booking</h2>
                    <h3>for your <span>salon</span></h3> 
                </div>
                <p>We help managing your appointments a breeze with a simple, secure and smart appointment system.</p>
                <br />
                <div class="mid-button"><?php echo CHtml::link('Try it for free',Yii::app()->request->baseUrl.'/pricing/');?>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="mid-part-right">
                <?php
                    $rightimg = CHtml::image(Yii::app()->baseUrl.'/images/right-img.png');
                    echo CHtml::link($rightimg,Yii::app()->request->baseUrl.'/pricing/');
                ?>
            </div>
        </div>
    </div>
</section>
 <div class="clear"></div>
<section>
    <div class="warrper">
    	<div class="mid-bottom">
            <div class="mid-bottom-boder">Features</div>
            <div class="clear"></div>
        </div>
            <div class="clear"></div>
    	<div class="slider">
            <div class="slider-left-bg">
                <div class="container">
                    <!-- Masthead -->
                    <!-- end masthead -->
                    <div id="feature-slideshow" style="width:940px;">
                        <div class="bjqs-wrapper" style="width: 940px; overflow: hidden; position: relative;">
                            <ul class="bjqs" style="width: 470px; left: -2820px; display: block;">
                                <li style="width: 940px; float: left; position: relative; display: list-item;height:240px;" class="bjqs-slide clone">
                                    <div class="featured-post">
                                       
                                       
                                            <?php
                                            echo CHtml::image(Yii::app()->baseUrl.'/images/banner1.png');
                                        ?>
                                       
                                    </div>
                                </li>
				 <li style="width: 940px; float: left; position: relative; display: list-item;height:240px;" class="bjqs-slide clone">
                                    <div class="featured-post">
                                       
                                     
                                            <?php
                                            echo CHtml::image(Yii::app()->baseUrl.'/images/banner2.png');
                                        ?>
                                      
                                    </div>
                                </li>
				  <li style="width: 940px; float: left; position: relative; display: list-item;height:240px;" class="bjqs-slide clone">
                                    <div class="featured-post">
                                       
                                        
                                            <?php
                                            echo CHtml::image(Yii::app()->baseUrl.'/images/banner3.png');
                                        ?>
                                       
                                    </div>
                                </li>
				   <li style="width: 940px; float: left; position: relative; display: list-item;height:240px;" class="bjqs-slide clone">
                                    <div class="featured-post">
                                       
                                        
                                            <?php
                                            echo CHtml::image(Yii::app()->baseUrl.'/images/banner4.png');
                                        ?>
                                       
                                    </div>
                                </li>
                                <!--<li style="width: 940px; float: left; position: relative; display: list-item;" class="bjqs-slide clone">
                                    <div class="featured-post">
                                        <?php
                                            echo CHtml::image(Yii::app()->baseUrl.'/images/slider-img.png');
                                        ?>
                                        <div class="slide-bottom">
                                            <h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h1>
                                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus accumsan massa non sapien bibendum ac ornare eros sollicitudin. Aliquam sed pharetra ante. Curabitur interdum rutrum mollis. In facilisis est non nulla convallis eleifend. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                             
                                            <div class="slider-cont-bottom">
                                                <div class="slider-cont-bottom-left">Robert Carter</div>
                                                <div class="slider-cont-bottom-right">Search marketing Consultant Bailimore, USA</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li style="width: 940px; float: left; position: relative; display: list-item;" class="bjqs-slide clone">-->
                                  
                            </ul>
                        </div>
      
                        <ul class="bjqs-controls">
                          <li><a href="#" class="bjqs-next"></a></li>
                          <li><a href="#" class="bjqs-prev"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</section>
 <div class="clear"></div>
<footer>
    <?php $this->widget('Footer');?>
</footer>
</body>
</html>
