<?php
Yii::import('application.extensions.qtip.QTip');

// qtip options
$opts = array(
    'position' => array(
	'center' => array(
	    'target' => 'rightMiddle',
	    'tooltip' => 'leftTop'
	    )
	),
    'show' => array(
	'when' => array('event' => 'mouseover' ),
	'effect' => array( 'length' => 300 )
    ),
    'hide' => array(
	'when' => array('event' => 'mouseout' ),
	'effect' => array( 'length' => 300 )
    ),
    'style' => array(
	'color' => 'black',
	'name' => 'blue',
	'border' => array(
	    'width' => 7,
	    'radius' => 5,
	),
    )
);
$jsSelector = '.new-td p[title]';

// apply tooltip on the jQuery selector (1 parameter)
QTip::qtip($jsSelector, $opts);

?>	
<div class="appbook">
   
   <div id="ajaxloader" style="display:none;"><center><img src="<?php echo Yii::app()->request->baseUrl;?>/images/ajax-loader.gif" /></center></div>
    <!--Left side calander html with jquery -->
    
      <div id="updateloader" class="updateloader" style="display:none;"><h1>You are in updation process...</h1></div>
     <!--Right side multiselect box jQuery -->
    <div class="appserviceselectbox" id="appservicebox">
	<?php 
	    //$data= CHtml::listData($services, 'id', 'name');
	    $multiselect = $this->widget('ext.EchMultiSelect.EchMultiSelect', array(
		//'model' => $service,
		'name' => 'service',
		'id'=>'service-form',
		'data' => $merchant_services,
		'value'=>array($merchant_services,'name'),
		'dropDownHtmlOptions'=> array(
		    'style'=>'width:250px;',
		   
		),
		
		'options' => array( 
//		   'header'=> 'taneja',
		    'selectedList'=>count($merchant_services),
		    'noneSelectedText'=>Yii::t('application','-- Select Services --'),
		    'selectedText'=>Yii::t('application','# service(s) selected'),
		    'selectedList'=>false,
		    'classes'=>'multiselectbox',

	       ),
	    ));
	?>
    </div>
    
    <br /> <br /> <br /><br />
    
    
 
</div>    





