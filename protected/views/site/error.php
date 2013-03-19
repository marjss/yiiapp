
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" type="text/css" media="screen">
</head>
<body>
    <header>
        <div class="top-outer"></div>
    </header>

    <div class="errorpage">
            <div class="logo1"><a href="<?php echo Yii::app()->request->baseUrl; ?>/">
                <?php echo CHtml::image(Yii::app()->baseUrl.'/images/logo.png');?></a>
            </div>
            <br />
            <div>
                <h1><?php echo $code; ?> Error - <?php if($code == '404') { echo "The page you are looking for was not found here."; } else { echo CHtml::encode($message); }?></h1>
            </div>
            
              <div class="errorpagelinks">Try one of the following:</div>
                
                    <div class="errorpagelink">
                            <ul>
                                    <li><?php echo CHtml::link('Home', Yii::app()->request->baseUrl.'/',array('class'=>'strong'))?></li>
                                    <li><?php echo CHtml::link('Register Page', Yii::app()->request->baseUrl.'/pricing/',array('class'=>'strong'))?></li>
                                    <li><?php echo CHtml::link('Login Page', Yii::app()->request->baseUrl.'/login/',array('class'=>'strong'))?></li>
                                    <li><?php echo CHtml::link('Features', Yii::app()->request->baseUrl.'/features/',array('class'=>'strong'))?></li>
                                    <li><?php echo CHtml::link('Pricing', Yii::app()->request->baseUrl.'/pricing/',array('class'=>'strong'))?></li>
                                    <li><?php echo CHtml::link('About us', Yii::app()->request->baseUrl.'/about/',array('class'=>'strong'))?></li>
                            </ul>
                    </div>
    </div>

 <div class="clear"></div>
<footer>
    <?php $this->widget('Footer');?>
</footer>
</body>
</html>

