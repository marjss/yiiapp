<?php

    $merchant_id = Yii::app()->user->id;
    $date = date('Y-m-d');
    
    //get merchant's seats
    $merseats = new Merseats;
    $seats = $merseats->getSeats();
    
    //get holidays's dates if exists
    $merholidays = new Merholidays;
    $disabledays = $merholidays->getHolidays();
    
    //get merchant services
    $merservices = new Merservices;
    $merchant_services = $merservices->getMerchantServices();
    
    //get today's timing attributes
    $week_day = strtolower(date('D'));
    $mertimings = new Mertimings;
    $mertimings_attr = $mertimings->getTodayTiming($week_day);
    
    //get today's booked appointment
    $custorders = new Customerorders;
    $custorders->gettodayBookedApp($date);
    
    //get booked service duraion acc to orders
    
    
?>

<div class="appbook">
    
    <!--Left side calander html with jquery -->
    <div class="appcalander">
	<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker',
		    array(
			    'name'=>'appdate',
			    'value' => $date,
			    'language' => 'en',
	    
			    //'themeUrl' => Yii::app()->baseUrl.'/css/jui' ,
			    'theme'=>'pool',	//try 'bee' also to see the changes
			    'cssFile'=>array('jquery-ui.css' /*,anotherfile.css, etc.css*/),
			    //  optional: jquery Datepicker options
			    'options' => array(
				    'dateFormat'=>'yy-mm-dd',
				    //'beforeShowDay'=>'nationalDays',
				    'changeMonth' => 'true',
				    'changeYear' => 'true',
				    'showButtonPanel' => 'false',
	    
				    // this is useful to allow only valid chars in the input field, according to dateFormat
				    'constrainInput' => 'false',
				    // speed at which the datepicker appears, time in ms or "slow", "normal" or "fast"
				    'duration'=>'fast',
    
				    // animation effect, see http://docs.jquery.com/UI/Effects
				    'showAnim' =>'slide',
			    ),	
			    // optional: html options will affect the input element, not the datepicker widget itself
			    'htmlOptions'=>array(
				'style'=>'height:28px;
				    background:#ffffff;
				    color:#00a;
				    font-weight:bold;
				    font-size:0.9em;
				    border: 1px solid #A80;
				    padding-left: 4px;',
				    
				'onchange'=>"alert('a')",
			    )
		    )
	    );
    
	?>  
    </div>
    
     <!--Right side multiselect box jQuery -->
    <div class="appserviceselectbox" id="appservicebox">
	<?php 
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
		   'header'=> Yii::t('application','Choose the services!'),
		    'selectedList'=>count($merchant_services),
	       ),
	    ));
	?>
    </div>
    
    
    <?php 
	    $k=12;
	    //Total grids in a row
	    $slot_grid_count = $mertimings_attr['slot_grids'];
    ?>
    
    
     <!--Appoinment table start -->
    <table width="100%" border="1" cellspacing="1" cellpadding="1" id="appbook_table">
	
	 <!--Table header for seats -->
       <thead style="text-align:center;">
	<th  id="table_info" style="background:none; border:none;" total_cols ="<?php echo count($seats);?>" total_rows ="<?php echo $mertimings_attr['total_rows'];?>" total_minutes ="<?php echo $mertimings_attr['totalminutes'];?>">&nbsp;</th>
	 <?php foreach($seats as $seat){  ?> 
		<th><strong><?php echo $seat->name; ?></strong></th>
	<?php } ?>
      </thead>
       <?php 
	    for($i=$mertimings_attr['starttime'];$i<$mertimings_attr['endtime'];$i++){ 
	?>
       
	    <tr>
	       <td  align="right" valign="top" style=" font-size:30px; width:100px;text-align:center;">
		    <strong> 	
			<?php 
			    if($i<12 || $i==24){
				if($i<12){
					echo $i." <br /><span>AM</span>";
				}
				if($i==24){
					echo ($i-$k)." <br /><span>AM</span>";
				}
			    }
			    if($i>=12 && $i!=24){
				if($i>=13){
					echo ($i-$k)." <br /><span>PM</span>";
				}
				if($i==12){
				  echo $i." <br /><span>PM</span>";
				}
			    }
			?>
		    </strong>
		</td>
	    
    
	 <?php foreach($seats as $key=>$seat){
		
		
		if($i==$mertimings_attr['starttime']){
		    if($mertimings_attr['sminute'] == '00' && $mertimings_attr['endminute'] == '00'){
			
			$class1 = 'slot_empty';
			$class2 = 'slot_empty';
			$class3 = 'slot_empty';
			$class4 = 'slot_empty';
		    }
		    elseif($mertimings_attr['sminute'] == '15'){
			$class1 = 'slot_disable';
			$class2 = 'slot_empty';
			$class3 = 'slot_empty';
			$class4 = 'slot_empty';
		    }
		    elseif($mertimings_attr['sminute'] == '30'){
			$class1 = 'slot_disable';
			$class2 = 'slot_disable';
			$class3 = 'slot_empty';
			$class4 = 'slot_empty';		
		    }
		    elseif($mertimings_attr['sminute'] == '45'){
			$class1 = 'slot_disable';
			$class2 = 'slot_disable';
			$class3 = 'slot_disable';
			$class4 = 'slot_empty';
		    }
		}
		if($i == ($mertimings_attr['endtime'] - 1)){    
		    if($mertimings_attr['sminute'] == '00' && $mertimings_attr['endminute'] == '00'){
			$class1 = 'slot_empty';
			$class2 = 'slot_empty';
			$class3 = 'slot_empty';
			$class4 = 'slot_empty';
		    }
		    elseif($mertimings_attr['endminute'] == '15'){
			$class1 = 'slot_empty';
			$class2 = 'slot_disable';
			$class3 = 'slot_disable';
			$class4 = 'slot_disable';
		    }
		    elseif($mertimings_attr['endminute'] == '30'){
			$class1 = 'slot_empty';
			$class2 = 'slot_empty';
			$class3 = 'slot_disable';
			$class4 = 'slot_disable';
		    }
		    elseif($mertimings_attr['endminute'] == '45'){
			$class1 = 'slot_empty';
			$class2 = 'slot_empty';
			$class3 = 'slot_empty';
			$class4 = 'slot_disable';
		    }	    
		}
	    ?> 
		<td>
		    <ul class="box-link">
			<li class = "<?php echo $class1; ?>"></li>
			<li class = "<?php echo $class2; ?>"></li>
			<li class = "<?php echo $class3; ?>"></li>
			<li class="last <?php echo $class4; ?>"></li>
		    </ul>
		</td>
	<?php
	
	    
	    $cust_ord_seat = new Customerorders;
	    $custord = $cust_ord_seat->gettodayBookedOnseat($date,$seat->id);
	    //echo "<pre>"; print_r(count($cust_ord_seat->attributes)); die;
	    
	    $bookedorders = array();
	    foreach($custord as $val){
		//echo "<pre>"; print_r($val->attributes); die;
		$duration = 0;
		$criteria = new CDbCriteria;
		$criteria->condition = "customer_order_id = '".$val->id."'";
		$orderdetails = Orderdetails::model()->findAll($criteria);
		foreach($orderdetails as $value){
		    $duration += $value->service_duration;
		}
		$hr = (int)($duration/60);
		$minutes = (int)($duration%60);
		
		$bookedorders[$val->merchant_seat_id]['duration'] = $duration;
		$bookedorders[$val->merchant_seat_id]['apptimehour'] = (int)date('H',strtotime($val->appointment_date_time));
		$bookedorders[$val->merchant_seat_id]['apptimemin'] = (int)date('i',strtotime($val->appointment_date_time));
		$bookedorders[$val->merchant_seat_id]['endhour'] = (int)date('i',strtotime($val->appointment_date_time));
		
		//echo $bookedorders[$val->merchant_seat_id]['apptimemin']; die;
	    }
	    
	}
		$class1 = 'slot_empty';
		$class2 = 'slot_empty';
		$class3 = 'slot_empty';
		$class4 = 'slot_empty';
	
	?>
    
	</tr>
       
	<?php } ?>
      
    </table>

</div>

<script type="text/javascript">
     
     $("#service").bind("multiselectbeforeclose", function(event, ui){
	
	   //var obj1 =$('#appbook_table tr').find();
	    $('#appbook_table li.slot_empty').each(function(){
		    
		    $(this).removeClass("highlighted_slot highlighted_slot_finish");	    
	    });
	    
	    //get the selected services from multi select checkboxes by using its method 'getChecked'
	    var selected_services = $("#service").multiselect("getChecked").map(function(){
	       return this.value;	
	   });
	    
	    
	    //create string of selected services
	    var str = '';
	   $.each(selected_services,function(index,val){
	       if(index == 0){
		   str = val;
	       }
	       else{
		   str = str+','+val;
	       }
	   });
	   
	   //Calculate the actual time & other values of the services from DB by calling a ajax url
            jQuery.ajax({
                url: '<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/getservices',     //controller action url
                type: "POST",
                data: {services : str},  
               
                success: function(resp){
		  var booked = resp;
		  
		  //get the table attributes defined
		  var total_rows =$('th#table_info').attr('total_rows');
		  var total_cols =$('th#table_info').attr('total_cols');
		  var total_minutes =$('th#table_info').attr('total_minutes');
		  
		  for(i=1; i<= total_cols ; i++){
		    var remaining_minutes = total_minutes;
		    var flag = 0;
		    for(j=1; j<= total_rows ; j++){
			
			var obj =$('tr').eq(j).find('td').eq(i);
			obj.find('li.slot_empty').each(function(){
			    if(flag == 1){
				return false;
			    }
			
			    $(this).addClass("highlighted_slot");
			    booked = booked - 15;
			    remaining_minutes = remaining_minutes - 15;
			    
			    if(remaining_minutes < resp && booked == 0){
				//alert(remaining_minutes+' '+resp+' din khatam')
				$(this).addClass("highlighted_slot_finish");
				flag = 1;
				booked = resp;
				return false;
			    }
			    if(booked == 0)
			    {
				//alert(remaining_minutes+' '+resp+' booking khatam')
				$(this).addClass("highlighted_slot_finish");
				booked = resp;    
			    }
			});
		    }
		  }
                }
            });
    });
     
    /*$(document).ready(function() {
	jQuery.ajax({
                      
	});
	
    });
    */
</script>


























<!--- Faltu  nahi hai kutte ye -->



<div class="appbook">
    
    <!--Left side calander html with jquery -->
    <div class="appcalander">
	<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker',
		    array(
			    'name'=>'appdate',
			    'value' => $date,
			    'language' => 'en',
	    
			    //'themeUrl' => Yii::app()->baseUrl.'/css/jui' ,
			    'theme'=>'pool',	//try 'bee' also to see the changes
			    'cssFile'=>array('jquery-ui.css' /*,anotherfile.css, etc.css*/),
			    //  optional: jquery Datepicker options
			    'options' => array(
				    'dateFormat'=>'yy-mm-dd',
				    //'beforeShowDay'=>'nationalDays',
				    'changeMonth' => 'true',
				    'changeYear' => 'true',
				    'showButtonPanel' => 'false',
	    
				    // this is useful to allow only valid chars in the input field, according to dateFormat
				    'constrainInput' => 'false',
				    // speed at which the datepicker appears, time in ms or "slow", "normal" or "fast"
				    'duration'=>'fast',
    
				    // animation effect, see http://docs.jquery.com/UI/Effects
				    'showAnim' =>'slide',
			    ),	
			    // optional: html options will affect the input element, not the datepicker widget itself
			    'htmlOptions'=>array(
				'style'=>'height:28px;
				    background:#ffffff;
				    color:#00a;
				    font-weight:bold;
				    font-size:0.9em;
				    border: 1px solid #A80;
				    padding-left: 4px;',
				    
				'onchange'=>"alert('a')",
			    )
		    )
	    );
    
	?>  
    </div>
    
     <!--Right side multiselect box jQuery -->
    <div class="appserviceselectbox" id="appservicebox">
	<?php 
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
		   'header'=> Yii::t('application','Choose the services!'),
		    'selectedList'=>count($merchant_services),
	       ),
	    ));
	?>
    </div>
    
    
    <?php 
	    $k=12;
    ?>
    
    
     <!--Appoinment table start -->
    <table width="100%" border="1" cellspacing="1" cellpadding="1" id="appbook_table">
	
	 <!--Table header for seats -->
       <thead style="text-align:center;">
	<th  id="table_info" style="background:none; border:none;" total_cols ="<?php echo count($seats);?>" total_rows ="<?php echo $mertimings_attr['total_rows'];?>" total_minutes ="<?php echo $mertimings_attr['totalminutes'];?>">&nbsp;</th>
	 <?php foreach($seats as $seat){  ?> 
		<th><strong><?php echo $seat->name; ?></strong></th>
	<?php } ?>
      </thead>
       <td style="width:50px;">
	  <?php
		foreach($appointment_book[$seat->id] as $key=>$slots)
		{
		    if(date('i',$key) == '00')
			echo "<div style='width:100px;text-align:center;border:1px solid red;'>".date('H',$key).'</div>';
		    
		    
		}
	 ?>
	
       </td>
     <?php
	$td_width = 100/count($seats);
	    foreach($seats as $seat){ //echo $mertimings_attr['starttime'];  ?>
	    <td style="width:<?php echo $td_width?>%">
	  
	    <table width="100%" border="" cellspacing="1" cellpadding="1" id="appbook_table_<?php echo $seat->id ?>" class="appbook_table">
		
	<?php
		foreach($appointment_book[$seat->id] as $key=>$slots)
		{
		    //echo "<tr><td>".date('H:i',$key).'</td>';
		    if($slots == ''){
			echo "<tr><td class='empty_slots'>&nbsp;</td></tr>";
		    }
		    else{
			echo "<tr><td class='booked_slots'>Booked</td></tr>";
		    }
		}
		echo "</table></td>";
		
	    }
	?>
	   
	
    </table>

</div>

<script type="text/javascript">
     
     $("#service").bind("multiselectbeforeclose", function(event, ui){
	
	   //var obj1 =$('#appbook_table tr').find();
	    $('.appbook_table td').each(function(){
		    
		    $(this).removeClass("highlighted_slot highlighted_slot_finish");	    
	    });
	    
	    //get the selected services from multi select checkboxes by using its method 'getChecked'
	    var selected_services = $("#service").multiselect("getChecked").map(function(){
	       return this.value;	
	   });
	    
	    
	    //create string of selected services
	    var str = '';
	   $.each(selected_services,function(index,val){
	       if(index == 0){
		   str = val;
	       }
	       else{
		   str = str+','+val;
	       }
	       //alert(str);
	   });
	   
	   //Calculate the actual time & other values of the services from DB by calling a ajax url
            jQuery.ajax({
                url: '<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/getservices',     //controller action url
                type: "POST",
                data: {services : str},  
               
                success: function(resp){
		  var booked = resp/15;
		  
		  //get the table attributes defined
		  var total_rows =$('th#table_info').attr('total_rows');
		  var total_cols =$('th#table_info').attr('total_cols');
		  var total_minutes =$('th#table_info').attr('total_minutes');
		  var slots = total_minutes/15;
		  
		  $('.appbook_table').each(function(){
		   
		    var flag = 0;
		    var is_empty =0;
			var obj =$(this);//$('tr').eq(j).find('td');
			obj.find('td').each(function(j){
			   if(j==0){
				  $('.temp').removeClass('temp');
			   }
			  //alert($(this).attr('class'));
			    if($(this).hasClass('empty_slots')){
				$(this).addClass('temp');
				//$(this).removeClass('empty_slots');
				is_empty++;
				if(is_empty==booked){
				    $(this).addClass('highlighted_slot_finish');
				   // $('.temp').eq(0).addClass('highlighted_slot_finish');
				   obj.find('.temp').addClass('highlighted_slot');
				   $('.temp').removeClass('temp');
				    is_empty=0;
				}
				//alert(is_empty+' out');
				
			    }else{
				//alert(is_empty+' class not');
				$('.temp').removeClass('temp');
				is_empty =0;
			    }
			});
		    
		});

                }
            });
    });
     
    /*$(document).ready(function() {
	jQuery.ajax({
                      
	});
	
    });
    */
</script>






