<?php
    
    Yii::import('application.extensions.EGMap.*');
    $city = $model->city;
    $model_city =   Citylist::model()->findByAttributes(array('city_name'=>$city));
    //echo $model_city->latitude;die;
    $gMap = new EGMap();
    $gMap->zoom = 10;
    $mapTypeControlOptions = array(
      'position'=> EGMapControlPosition::LEFT_BOTTOM,
      'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
    );
     
    $gMap->mapTypeControlOptions= $mapTypeControlOptions;
     
    $gMap->setCenter($model_city->latitude, $model_city->longitude );
     
    // Create GMapInfoWindows
    $info_window_a = new EGMapInfoWindow('<div>I am a marker with custom image!</div>');
    $info_window_b = new EGMapInfoWindow('Hey! I am a marker with label!');
     
    $icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/gazstation.png");
     
    $icon->setSize(32, 37);
    $icon->setAnchor(16, 16.5);
    $icon->setOrigin(0, 0);
     
    // Create marker
    $marker = new EGMapMarker($model_city->latitude, $model_city->longitude, array('title' => 'Marker With Custom Image','icon'=>$icon));
    $marker->addHtmlInfoWindow($info_window_a);
    $gMap->addMarker($marker);
     
    // Create marker with label
    $marker = new EGMapMarkerWithLabel($model_city->latitude, $model_city->longitude, array('title' => 'Marker With Label'));
     
    $label_options = array(
      'backgroundColor'=>'yellow',
      'opacity'=>'0.75',
      'width'=>'100px',
      'color'=>'blue'
    );
    $gMap->renderMap()
   //$merchant	=	$this->getMerchantDetails($merchant_id);
		
      
      /*Yii::import('application.extensions.EGMap.*');
        
		$gMap = new EGMap();
		$gMap->zoom = 10;
		$mapTypeControlOptions = array(
		  'position'=> EGMapControlPosition::LEFT_BOTTOM,
		  'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
		);
     
		$gMap->mapTypeControlOptions= $mapTypeControlOptions;
		 
		$gMap->setCenter(39.721089311812094, 2.91165944519042);
		 
		// Create GMapInfoWindows
		$info_window_a = new EGMapInfoWindow('<div>I am a marker with custom image!</div>');
		$info_window_b = new EGMapInfoWindow('Hey! I am a marker with label!');
		 
		$icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/gazstation.png");
		 
		$icon->setSize(32, 37);
		$icon->setAnchor(16, 16.5);
		$icon->setOrigin(0, 0);
		 
		// Create marker
		$marker = new EGMapMarker(39.721089311812094, 2.91165944519042, array('title' => 'Marker With Custom Image','icon'=>$icon));
		$marker->addHtmlInfoWindow($info_window_a);
		$gMap->addMarker($marker);
		 
		// Create marker with label
		$marker = new EGMapMarkerWithLabel(39.821089311812094, 2.90165944519042, array('title' => 'Marker With Label'));
		 
		$label_options = array(
		  'backgroundColor'=>'yellow',
		  'opacity'=>'0.75',
		  'width'=>'100px',
		  'color'=>'blue'
		);
		$gMap->renderMap();
      */
?>