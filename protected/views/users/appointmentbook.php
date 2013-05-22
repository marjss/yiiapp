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
    <div class="appcalander">
	<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker',
		    array(
			    'name'=>'appdate',
			    'value' => $date,
			    'language' => 'en',
			    "id"=>"selectdate",
			    //'themeUrl' => Yii::app()->baseUrl.'/css/jui' ,
			    'theme'=>'pool',	//try 'bee' also to see the changes
			    'cssFile'=>array('jquery-ui.css' /*,anotherfile.css, etc.css*/),
			    //  optional: jquery Datepicker options
			    'options' => array(
				    'dateFormat'=>'yy-mm-dd',
				    'changeMonth' => 'true',
				    'changeYear' => 'true',
//				    'showButtonPanel' => 'false',
                                
				    // this is useful to allow only valid chars in the input field, according to dateFormat
				    'constrainInput' => 'false',
				    // speed at which the datepicker appears, time in ms or "slow", "normal" or "fast"
				    'duration'=>'fast',
    
				    // animation effect, see http://docs.jquery.com/UI/Effects
				    'showAnim' =>'slide',
			    ),	
			    // optional: html options will affect the input element, not the datepicker widget itself
			    'htmlOptions'=>array(
				'style'=>'height:25px;
				    background:#ffffff;
				    color:#00a;
				    font-weight:bold;
				    font-size:0.9em;
				    border: 1px solid #A80;
				    padding-left: 4px; margin-top: 10px;',
				'onchange'=>"return getappointmentbook()",
			    )
		    )
	    );
    
	?>
	 <span class='cal-icon' id="calicon"><?php echo CHtml::image(Yii::app()->baseUrl.'/images/calendar.png');?></span>
	  
    </div>
      <div id="updateloader" class="updateloader" style="display:none;"><h1>You are in updation process...</h1></div>
     <!--Right side multiselect box jQuery -->
     
   <div class="appserviceselectbox" id="appservicebox">
		<a href="javascript: void(0)" id="service-select">-- Select Services -- <span></span></a>
		<div class="mservices-wrapper">
                    <?php $this->widget('AppointmentSelectbox'); ?>
		</div>
	<?php
		/*
	    //$data= CHtml::listData($services, 'id', 'name');
	    $multiselect = $this->widget('ext.EchMultiSelect.EchMultiSelect', array(
		//'model' => $service,
		'name' => 'service',
		
		'data' => $merchant_services,
		//'value'=>array($merchant_services,'name'),
		'dropDownHtmlOptions'=> array(
		    'style'=>'width:250px;',
		   
		),
		
		'options' => array( 
		   'header'=> 'taneja',
		    'selectedList'=>count($merchant_services),
		    'noneSelectedText'=>Yii::t('application','-- Select Services --'),
		    'selectedText'=>Yii::t('application','# service(s) selected'),
		    'selectedList'=>false,
		    'classes'=>'multiselectbox',

	       ),
	    ));*/
	?>
   </div>
     
    
    <br /> <br /> <br /><br />
    
    <div id = "appointmenttable">
     <div class="left-date-block">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top" class="date-box">
	    
	    <?php
		  $k=12;
		  for($i=$mertimings_attr['starttime'];$i<$mertimings_attr['endtime'];$i++){ 
		  
			  
			  if($i<12 || $i==24){
			     if($i<12){
				  if($i==$mertimings_attr['starttime'])
				      echo '<div class="date"><h1>'.$i.':'.$mertimings_attr['sminute']."<span>AM</span></h1></div>";
				  elseif($i==$mertimings_attr['endtime'] - 1)
				      echo '<div class="date date-bottom"><h1>'.$i.':'.$mertimings_attr['endminute']."<span>AM</span></h1></div>";
				  else
				     echo '<div class="date height-1"><h1>'.$i.":00<span>AM</span></h1></div>";
			     }
			     if($i==24){
				      if($i==$mertimings_attr['starttime'])
					  echo '<div class="date"><h1>'.($i-$k).':'.$mertimings_attr['sminute']."<span>AM</span></h1></div>";
				      elseif($i==$mertimings_attr['endtime'] - 1)
					  echo '<div class="date date-bottom"><h1>'.($i-$k).':'.$mertimings_attr['endminute']."<span>AM</span></h1></div>";
				      else
					 echo '<div class="date height-1"><h1>'.($i-$k).":00<span>AM</span></h1></div>";
			     }
			 }
			 if($i>=12 && $i!=24){
			     if($i>=13){
				     if($i==$mertimings_attr['starttime'])
					  echo '<div class="date"><h1>'.($i-$k).':'.$mertimings_attr['sminute']."<span>PM</span></h1></div>";
				      elseif($i==$mertimings_attr['endtime'] - 1)
					  echo '<div class="date date-bottom"><h1>'.($i-$k).':'.$mertimings_attr['endminute']."<span>PM</span></h1></div>";
				      else
					 echo '<div class="date height-1"><h1>'.($i-$k).":00 <span>PM</span></h1></div>";;
			     }
			     if($i==12){
				      if($i==$mertimings_attr['starttime'])
					  echo '<div class="date"><h1>'.$i.':'.$mertimings_attr['sminute']."<span>PM</span></h1></div>";
				      elseif($i==$mertimings_attr['endtime'] - 1)
					  echo '<div class="date date-bottom"><h1>'.$i.':'.$mertimings_attr['endminute']."<span>PM</span></h1></div>";
				      else
					 echo '<div class="date height-1"><h1>'.$i.":00 <span>PM</span></h1></div>";
			     }
			 }
			 
		  }
	   ?>
	  </td>
        </tr>
      </table>
    </div>
     <?php 
     $j=0;
     foreach($seats as $seat){$j++;}
      if($j<= 5){$tablewidth = 888;}
        elseif($j>= 5 && $j<=10){$tablewidth = 1200;}
            elseif($j>= 10 && $j<=20){$tablewidth = 1350;}
     ?>
      <!--Appoinment table start -->
    <div class="add-block" style="overflow:auto;">
       <table width="<?php echo $tablewidth ?>px" border="0" cellspacing="0" cellpadding="0" style="overflow:scroll;" style="border-bottom: 2px solid #949494;" id="appbook_table">
	      <!--Table header for seats -->
	      
		 <thead style="text-align:center;">
		     <tr>
		  <th  id="table_info" style="background:none; border:none; display:none;" total_cols ="<?php echo count($seats);?>" total_rows ="<?php echo $mertimings_attr['total_rows'];?>" total_minutes ="<?php echo $mertimings_attr['totalminutes'];?>" last_timestamp ="<?php echo $mertimings_attr['last_timestamp'];?>" first_timestamp ="<?php echo $mertimings_attr['first_timestamp'];?>" last_timestring ="<?php echo $mertimings_attr['last_timestring'];?>">&nbsp;</th>
		   <?php foreach($seats as $seat){  ?> 
			  <th><strong><?php echo $seat->name; ?></strong></th>
		  <?php } ?>
		   </tr>
		</thead>
		    <tr>
	     <?php  
           
	    if(count($seats) <= 10){
               $td_width = (int)($tablewidth/count($seats));
	    }
	    else{
		$td_width = $tablewidth/10;
	    }
		 foreach($seats as $seat){ $slotcount = 0;  $width = $td_width.'px';?>
	     
	  
	     <td style="width:<?php echo $td_width?>px;" class="dea" valign="top" id="appbook_table_seat">
		 
	     
	     
	     <?php 
//                 $timezone = "Asia/Calcutta";
//                   date_default_timezone_set($timezone);
//            $date = date('Y-m-d');
//            $week_day = strtolower(date('D'));
//            $merchant_id = Yii::app()->user->id;
//            $today_timings1= Mertimings::model()->findByAttributes(array('day'=>$week_day,'status'=>1,'merchant_id'=>$merchant_id));
//                        
//                        $today= strtolower(date('D'));
//                        echo $today;
//                        echo $mertimings_attr['sminute'];echo '<br>';
//			
//                    if($today_timings1->day == $today){
//                        if(date("H:i:s")> $today_timings->opening_at)
//                            {
//                            echo  $stime= date("H:i:s");
//                        }
//                        $etime = $today_timings1->closing_at;
//                    }else{
//                        
//                    }
//                    echo '<pre>';
//                     print_r($today_timings1->day)  ;
//                     print_r($mertimings_attr);
//                  echo '</pre>';
                  $rounded= $mertimings_attr['sminute'];
                  $rounded = $rounded -($rounded % 15);
//                  if($stime <= ''){                                          //$mertimings_attr['sminute']
//                  echo "<div class='new-td disable_slots'>&nbsp</div>";
//		    echo "<div class='new-td disable_slots'>&nbsp</div>";
//		    echo "<div class='new-td disable_slots'>&nbsp</div>";
//		    echo "<div class='new-td disable_slots'>&nbsp</div>";
//		    $slotcount += 4;
//		 }
//                  
		 if($mertimings_attr['sminute'] == '15'){                                          //$mertimings_attr['sminute']
                     
		     echo "<div class='new-td disable_slots'>&nbsp</div>";
		     $slotcount += 1;
		 }
		 elseif($mertimings_attr['sminute'] == '30'){                                      //$mertimings_attr['sminute']
		    echo "<div class='new-td disable_slots'>&nbsp</div>";
		    echo "<div class='new-td disable_slots'>&nbsp</div>";
		    $slotcount += 2;
		 }
		 elseif($mertimings_attr['sminute'] == '45'){                                      //$mertimings_attr['sminute']
		    echo "<div class='new-td disable_slots'>&nbsp</div>";
		    echo "<div class='new-td disable_slots'>&nbsp</div>";
		    echo "<div class='new-td disable_slots'>&nbsp</div>";
		    $slotcount += 3;
		 }
		 $process = array(0);
		 foreach($appointment_book[$seat->id] as $key=>$slots)
		 {
		    
		     $slotcount++;
		     if(($slotcount % 4) == 0){
			 $time1 ='"'.date('g:i A',$key).'"';
			 if($slots == ''){
			     echo "<div class='new-td bottomnew-border empty_slots' style='width:$width;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1.">&nbsp;</div>";
			 }
			 elseif($slots == 'disable'){
			     echo "<div class='new-td bottomnew-border disable_slots' style='width:$width;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1.">&nbsp;</div>";
			 }
			 else{
			    if($slots['status'] == 1){
			      // print_r($slots); die;
				 if(!in_array($slots['id'],$process)){
					$os= $slots['duration']/15;
					$bb= $os/4+1;
					$height = (18+1)*$os+2*(int)$bb;
					$height .= 'px';
					$custinfo = $slots['customer_name']."<br />".$slots['customer_contact_no'];
					$tooltipinfo = date('h:i A',$slots['starttimestamp'])." - ".date('h:i A',$slots['endtimestamp'])."<br />".$slots['services1'];
					
					   echo "<div class='new-td bottomnew-border booked_slots' style='width:$width;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1." orderid = ".$slots['id'].">
						 <div class='booked-space'  style='height:$height;width:$width;'>";
				 ?>
					 <!--<p onmouseover="ddrivetip('Taneja','#faf9f9', 265)" onmouseout='hideddrivetip()'><?php //echo $custinfo; ?></p> -->
					 <p title="<?php echo $tooltipinfo; ?>"><?php echo $custinfo; ?></p>
					 </div>
					      </div>
			     <?php
				     
				 }
				 else{
				     echo "<div class='new-td bottomnew-border booked_slots'  style='width:$width;visibility:hidden;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1." orderid = ".$slots['id']."></div>";
				 }
			    }
			     elseif($slots['status'] == 3){
			      // print_r($slots); die;
				 if(!in_array($slots['id'],$process)){
				   //Get services of updated order
				   $ord_details = new Orderdetails;
				   $bookorder = $ord_details->getBookedorder($slots['id']);
				   $booked_services = $bookorder['serviceids'];
				   $orderid = $slots['id'];
				   $custid = $slots['customer_id'];
				   //echo "<pre>"; print_r($bookorder['serviceids']); die;
				   $os= $slots['duration']/15;
				   $bb= $os/4+1;
				   $height = (18+1)*$os+2*(int)$bb;
				   $custinfo = $slots['customer_name']."<br />".$slots['customer_contact_no'];
				   $upcustinfo = $slots['customer_name']." , ".$slots['customer_contact_no'];
				   $tooltipinfo = date('h:i A',$slots['starttimestamp'])." - ".date('h:i A',$slots['endtimestamp'])."<br />".$slots['services1'];
					
					   echo "<div class='new-td bottomnew-border empty_slots updated_slots' style='width:$width;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1." orderid = ".$slots['id']." booked_services = ".$booked_services.">
						 <div class='updated-space'  style='height:$height;width:$width;'  booked_services = '$booked_services' orderid = '$orderid' customerid = '$custid' customerinfo = '$upcustinfo'>";
				 ?>
					 <!--<p onmouseover="ddrivetip('Taneja','#faf9f9', 265)" onmouseout='hideddrivetip()'><?php //echo $custinfo; ?></p> -->
					 <p title="<?php echo $tooltipinfo; ?>"><?php echo $custinfo; ?></p>
					 </div>
					      </div>
			     <?php
				     
				 }
				 else{
				     echo "<div class='new-td bottomnew-border empty_slots updated_slots'  style='width:$width; visibility:hidden;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1." orderid = ".$slots['id']."></div>";
				 }
			    }
                            elseif($slots['status'] == 4){
//			       print_r($slots); die;
				 if(!in_array($slots['id'],$process)){
					$os= $slots['duration']/15;
					$bb= $os/4+1;
					$height = (18+1)*$os+2*(int)$bb;
					$height .= 'px';
					$custinfo = $slots['customer_name']."<br />".$slots['customer_contact_no'];
					$tooltipinfo = date('h:i A',$slots['starttimestamp'])." - ".date('h:i A',$slots['endtimestamp'])."<br />".$slots['services1'];
					
					   echo "<div class='new-td bottomnew-border complete_slots booked_slots' style='width:$width;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1." orderid = ".$slots['id'].">
						 <div class='complete-space'  style='height:$height;width:$width;'>";
				 ?>
					 <!--<p onmouseover="ddrivetip('Taneja','#faf9f9', 265)" onmouseout='hideddrivetip()'><?php //echo $custinfo; ?></p> -->
					 <p title="<?php echo $tooltipinfo; ?>"><?php echo $custinfo; ?></p>
					 </div>
					      </div>
			     <?php }
				 else{
				     echo "<div class='new-td bottomnew-border booked_slots'  style='width:$width;visibility:hidden;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1." orderid = ".$slots['id']."></div>";
                                     }
                                }
			       $process[] = $slots['id'];
                             }
		     }
		     else{
			
			 $time1 ='"'.date('g:i A',$key).'"';
			 if($slots == ''){
			     echo "<div class='new-td empty_slots' style='width:$width;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1.">&nbsp;</div>";
			 }
			 elseif($slots == 'disable'){
			     echo "<div class='new-td disable_slots' style='width:$width;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1.">&nbsp;</div>";
			 }
			 else{
			    if($slots['status'] == 1){
				   // echo date('h:i:s',$slots['endtimestamp']); die;
				    if(!in_array($slots['id'],$process)){
					
					$os= $slots['duration']/15;
					$bb= $os/4;
					$height = (18+1)*$os+(2-1)*(int)$bb;
					$height= $height.'px';
					$custinfo = $slots['customer_name']."<br />".$slots['customer_contact_no'];
					$tooltipinfo = date('h:i A',$slots['starttimestamp'])." - ".date('h:i A',$slots['endtimestamp'])."<br />".$slots['services1'];
					
					    echo "<div class='new-td  booked_slots' style='width:$width;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1." orderid = ".$slots['id'].">
						    <div class='booked-space'  style='height:$height;width:$width;'  >";
				    ?>
					   <!--<p onmouseover="ddrivetip('Taneja','#faf9f9', 265)" onmouseout='hideddrivetip()'><?php //echo $custinfo; ?></p> -->
					    <p title="<?php echo $tooltipinfo; ?>"><?php echo $custinfo; ?></p>
					    </div>
						 </div>
				<?php
				    }
				    else{
					echo "<div class='new-td booked_slots' style='width:$width; visibility:hidden;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1." orderid = ".$slots['id']."></div>";
				    }
			    }
                            if($slots['status'] == 4){
				   // echo date('h:i:s',$slots['endtimestamp']); die;
				    if(!in_array($slots['id'],$process)){
					
					$os= $slots['duration']/15;
					$bb= $os/4;
					$height = (18+1)*$os+(2-1)*(int)$bb;
					$height= $height.'px';
					$custinfo = $slots['customer_name']."<br />".$slots['customer_contact_no'];
					$tooltipinfo = date('h:i A',$slots['starttimestamp'])." - ".date('h:i A',$slots['endtimestamp'])."<br />".$slots['services1'];
					
					    echo "<div class='new-td  complete_slots booked_slots' style='width:$width;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1." orderid = ".$slots['id'].">
						    <div class='complete-space'  style='height:$height;width:$width;'  >";
				    ?>
					   <!--<p onmouseover="ddrivetip('Taneja','#faf9f9', 265)" onmouseout='hideddrivetip()'><?php //echo $custinfo; ?></p> -->
					    <p title="<?php echo $tooltipinfo; ?>"><?php echo $custinfo; ?></p>
					    </div>
						 </div>
				<?php
				    }
				    else{
					echo "<div class='new-td booked_slots' style='width:$width; visibility:hidden;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1." orderid = ".$slots['id']."></div>";
				    }
			    }
			   elseif($slots['status'] == 3){
				   // echo date('h:i:s',$slots['endtimestamp']); die;
				    if(!in_array($slots['id'],$process)){
					//Get services of updated order
					$ord_details = new Orderdetails;
					$bookorder = $ord_details->getBookedorder($slots['id']);
					$booked_services = $bookorder['serviceids'];
					$orderid = $slots['id'];
					$custid = $slots['customer_id'];
					//echo "<pre>"; print_r($bookorder['serviceids']); die;
					 
					
					$os= $slots['duration']/15;
					$bb= $os/4;
					$height = (18+1)*$os+(2-1)*(int)$bb;
					$height= $height.'px';
					$custinfo = $slots['customer_name']."<br />".$slots['customer_contact_no'];
					$upcustinfo = $slots['customer_name']." , ".$slots['customer_contact_no'];
					$tooltipinfo = date('h:i A',$slots['starttimestamp'])." - ".date('h:i A',$slots['endtimestamp'])."<br />".$slots['services1'];
					
					    echo "<div class='new-td empty_slots updated_slots' style='width:$width;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1." orderid = ".$slots['id']." booked_services = ".$booked_services.">
						    <div class='updated-space'  style='height:$height;width:$width;' booked_services = '$booked_services' orderid = '$orderid' customerid = '$custid' customerinfo = '$upcustinfo'>";
				    ?>
					   <!--<p onmouseover="ddrivetip('Taneja','#faf9f9', 265)" onmouseout='hideddrivetip()'><?php //echo $custinfo; ?></p> -->
					    <p title="<?php echo $tooltipinfo; ?>"><?php echo $custinfo; ?></p>
					    </div>
						 </div>
				<?php
				    }
				    else{
					echo "<div class='new-td empty_slots updated_slots' style='width:$width; visibility:hidden' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1." orderid = ".$slots['id']."></div>";
				    }
			    }
			   
			    $process[] = $slots['id'];
			 }
		     }
		 }
		 
		 if($mertimings_attr['endminute'] == '15'){
		     echo "<div class='new-td disable_slots'>&nbsp</div>";
		     echo "<div class='new-td disable_slots'>&nbsp</div>";
		     echo "<div class='new-td disable_slots'>&nbsp</div>";
		 }
		 elseif($mertimings_attr['endminute'] == '30'){
		     echo "<div class='new-td disable_slots'>&nbsp</div>";
		     echo "<div class='new-td disable_slots'>&nbsp</div>";
		 }
		 elseif($mertimings_attr['endminute'] == '45'){
		     echo "<div class='new-td disable_slots'>&nbsp</div>";
		 }
	 ?>
	     </td>
	 
	 <?php }
	  
	 ?>
	 </tr>
       </table>
        <div class="clear"></div>
    </div>
     <div class="clear"></div>
    </div>
 <?php $this->widget('CustomerLookup');  //echo $disabletoday; die;?>
 <?php $this->widget('UpdateOrder');  ?>
  <?php $this->widget('AppointmentSuccess'); ?>
    <?php  $this->widget('Invoice'); ?>
    <input type="hidden" id = "service_duration" name="service_duration" value = "0">
    <input type="hidden" id = "selectable_slots" name="selectable_slots" value = "0">
     <input type="hidden" id = "updated_order" name="updated_order" value = "0">
     <input type="hidden" id = "updated_custinfo" name="updated_custinfo" value = "0">
	<div class="color-ind">
	    <?php echo CHtml::Image(Yii::app()->request->baseUrl.'/images/whitesmoke.png'); ?><p>Not Available</p>
            <?php echo CHtml::Image(Yii::app()->request->baseUrl.'/images/darkgreen.png'); ?><p>Completed</p>
	    <?php echo CHtml::Image(Yii::app()->request->baseUrl.'/images/darkpink.png'); ?><p>Booked</p>
	    <?php echo CHtml::Image(Yii::app()->request->baseUrl.'/images/lightyellow.png'); ?><p>Available</p>
	</div>
 
</div>    
<script type="text/javascript">
function getappointmentbook()
{
        jQuery('#appservicebox').css('visibility','visible');
	var date 	= 	jQuery("#selectdate").attr('value');
        
	var d 		=  new Date();
	var today	=	d.getFullYear() + "/" +	("0" + (d.getMonth() + 1)).slice(-2) + "/" +("0" + d.getDate()).slice(-2);
  
	// Disable a list of dates
	
	var disabledDays = [<?php echo $disabletoday; ?>];
        
        jQuery(".appbook").css("opacity","0.5");

	jQuery.ajax({
		url: '<?php echo Yii::app()->request->baseUrl; ?>/users/appointment',     //controller action url
		type: "POST",
		data: {date : date},  
		
		success: function(resp){    
			 var obj =jQuery(resp);
			 obj.find("#customerDialog").dialog({autoOpen:false});
			 jQuery("#appointmenttable").html(obj.find('#appointmenttable').html());
			 jQuery(".new-td p[title]").qtip({'position':{'center':{'target':'rightMiddle','tooltip':'leftTop'}},'show':{'when':{'event':'mouseover'},'effect':{'length':300}},'hide':{'when':{'event':'mouseout'},'effect':{'length':300}},'style':{'color':'black','name':'blue','border':{'width':7,'radius':5}}});
			 jQuery(".appbook").css("opacity","1");
			 resetgrid();
                         
		}
	});
        var arr = String(disabledDays).split(',');
        jQuery.each(arr,function(i){
            if(date == arr[i]){
            jQuery('#appservicebox').css('visibility','hidden');}
            });
       }
</script>



