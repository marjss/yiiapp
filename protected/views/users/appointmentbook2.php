
<div class="appbook">
   
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
				    
				'onchange'=>"return getappointmentbook()",
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
	<th  id="table_info" style="background:none; border:none;" total_cols ="<?php echo count($seats);?>" total_rows ="<?php echo $mertimings_attr['total_rows'];?>" total_minutes ="<?php echo $mertimings_attr['totalminutes'];?>" last_timestamp ="<?php echo $mertimings_attr['last_timestamp'];?>" first_timestamp ="<?php echo $mertimings_attr['first_timestamp'];?>" last_timestring ="<?php echo $mertimings_attr['last_timestring'];?>">&nbsp;</th>
	 <?php foreach($seats as $seat){  ?> 
		<th><strong><?php echo $seat->name; ?></strong></th>
	<?php } ?>
      </thead>
       <td style="width:50px;">
	  <?php
		$k=12;
		for($i=$mertimings_attr['starttime'];$i<$mertimings_attr['endtime'];$i++){ 
		
			echo "<div><strong>";
			if($i<12 || $i==24){
			   if($i<12){
				if($i==$mertimings_attr['starttime'])
				    echo $i.':'.$mertimings_attr['sminute']." <br /><span>AM</span>";
				elseif($i==$mertimings_attr['endtime'] - 1)
				    echo $i.':'.$mertimings_attr['endminute']." <br /><span>AM</span>";
				else
				   echo $i." <br /><span>AM</span>";
			   }
			   if($i==24){
				    if($i==$mertimings_attr['starttime'])
					echo ($i-$k).':'.$mertimings_attr['sminute']." <br /><span>AM</span>";
				    elseif($i==$mertimings_attr['endtime'] - 1)
					echo ($i-$k).':'.$mertimings_attr['endminute']." <br /><span>AM</span>";
				    else
				       echo ($i-$k)." <br /><span>AM</span>";
			   }
		       }
		       if($i>=12 && $i!=24){
			   if($i>=13){
				   if($i==$mertimings_attr['starttime'])
					echo ($i-$k).':'.$mertimings_attr['sminute']." <br /><span>PM</span>";
				    elseif($i==$mertimings_attr['endtime'] - 1)
					echo ($i-$k).':'.$mertimings_attr['endminute']." <br /><span>PM</span>";
				    else
				       echo ($i-$k)." <br /><span>PM</span>";
			   }
			   if($i==12){
				    if($i==$mertimings_attr['starttime'])
					echo $i.':'.$mertimings_attr['sminute']." <br /><span>PM</span>";
				    elseif($i==$mertimings_attr['endtime'] - 1)
					echo $i.':'.$mertimings_attr['endminute']." <br /><span>PM</span>";
				    else
				       echo $i." <br /><span>PM</span>";
			   }
		       }
		        echo "</div></strong>";
		}
	 ?>
	
       </td>
      
	<?php
	$td_width = 100/count($seats);
	    foreach($seats as $seat){ //echo $mertimings_attr['starttime'];  ?>
	    <td style="width:<?php echo $td_width?>%">
	  
	    <table width="100%" border="1" cellspacing="1" cellpadding="1" id="appbook_table_<?php echo $seat->id ?>" class="appbook_table">
		
	<?php
	
		if($mertimings_attr['sminute'] == '15'){
		    echo "<tr><td class='disable_slots'>&nbsp</td></tr>";
		   
		}
		elseif($mertimings_attr['sminute'] == '30'){
		   echo "<tr><td class='disable_slots'>&nbsp</td></tr>";
		   echo "<tr><td class='disable_slots'>&nbsp</td></tr>";
		}
		elseif($mertimings_attr['sminute'] == '45'){
		    echo "<tr><td class='disable_slots'>&nbsp</td></tr>";
		    echo "<tr><td class='disable_slots'>&nbsp</td></tr>";
		    echo "<tr><td class='disable_slots'>&nbsp</td></tr>";
		}
		
		foreach($appointment_book[$seat->id] as $key=>$slots)
		{
		    $time1 ='"'.date('g:i A',$key).'"';
		    if($slots == ''){
			echo "<tr><td class='empty_slots' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1.">&nbsp;</td></tr>";
		    }
		    elseif($slots == 'disable'){
			echo "<tr><td class='disable_slots' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1.">&nbsp;</td></tr>";
		    }
		    else{
			echo "<tr><td class='booked_slots' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1." orderid = ".$slots['id'].">Booked</td></tr>";
		    }
		}
		if($mertimings_attr['endminute'] == '15'){
		    echo "<tr><td class='disable_slots'>&nbsp</td></tr>";
		    echo "<tr><td class='disable_slots'>&nbsp</td></tr>";
		    echo "<tr><td class='disable_slots'>&nbsp</td></tr>";
		}
		elseif($mertimings_attr['endminute'] == '30'){
		    echo "<tr><td class='disable_slots'>&nbsp</td></tr>";
		    echo "<tr><td class='disable_slots'>&nbsp</td></tr>";
		}
		elseif($mertimings_attr['endminute'] == '45'){
		    echo "<tr><td class='disable_slots'>&nbsp</td></tr>";
		}
		echo "</table></td>";
		
	    }
	?>
	   
	
    </table>
       <?php $this->widget('CustomerLookup'); ?>
       <?php $this->widget('AppointmentSuccess'); ?>
    <input type="hidden" id = "service_duration" name="service_duration" value = "0">
    <input type="hidden" id = "selectable_slots" name="selectable_slots" value = "0">

 
</div>    
 
<script type="text/javascript">
     
	$("#service").bind("multiselectbeforeclose", function(event, ui){
	    gethighlightedslots();
	});
    
    function gethighlightedslots(){
		      //var obj1 =$('#appbook_table tr').find();
	       $('.appbook_table td.empty_slots').each(function(){
		   $(this).removeClass('highlighted_slot highlighted_slot_finish');
	       });
	       //get the selected services from multi select checkboxes by using its method 'getChecked'
	       var selected_services = $("#service").multiselect("getChecked").map(function(){
		  return this.value;	
	      });
	     //  alert(selected_services[0]);
	      if(selected_services[0] == 'undefined'){
		   resethover();
		   $('.highlighted_slot').removeClass('highlighted_slot');
		   $('.highlighted_slot_finish').removeClass('highlighted_slot_finish');
		   $('.temp').removeClass('temp');
		   return false;
	       }
	   
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
		       $("#service_duration").val(resp);
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
				   $(this).addClass('temp selectable');
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
				   $('.temp').removeClass('temp selectable');
				   is_empty =0;
			       }
			   });
		       
		   });
   
		   }
	       });
     
    }
    $(document).ready(function() {
	var today = $("#selectdate").attr('value');
	 // Disable a list of dates
	var widget =  $("#service").multiselect();
	var disabledDays = [<?php echo $disabletoday; ?>];
	if($.inArray(today,disabledDays) == 1) {
	  
	    widget.multiselect("disable");
	}
	$('.appbook_table td.booked_slots').live("click",function(){
		var today = $("#selectdate").attr('value');
		var orderid = $(this).attr('orderid');
		var dailog= $('<div id="booked_dialog_wrapper"></div>');
		$('body').append(dailog);
		$("#booked_dialog_wrapper").load('<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/getbookedorder/'+orderid).dialog({
		    autoOpen:true,
		      height: 'auto',
                      width: 450,
		      modal: true,
		  buttons: {
			"cancel":function(){
			    if(confirm("Are you sure?")){
				//$(this).load('<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/cancelorder/'+orderid);
				//$(this).dialog("close");
				
				$.ajax({
				    url: '<?php echo Yii::app()->request->baseUrl; ?>/users/appointment',     //controller action url
				    type: "POST",
				    data: {date : today,orderid:orderid,operation:'delete'},  
				    success:function(resp){
					var obj =$(resp);
					$("#appbook_table").html(obj.find('#appbook_table').html());
					$(this).dialog("destroy");
					$('#booked_dialog_wrapper').remove();
				    }    
				});
			    }
			   
			},
		    	"update":function(){
			    alert(0);
			}
			
		    },
		  close:function(){
		    $(this).dialog("destroy");
		    $('#booked_dialog_wrapper').remove();
		    }  
		    });
	 });
	
	
	$('.appbook_table td.selected_slot').live("click",function(){
		
		//getselectedslot();
		var stime= $("#starttime").val();
		var etime= $("#endtime").val();
		var lt =$('th#table_info').attr('last_timestamp');
		var ls =$('th#table_info').attr('last_timestring');
		var seatid = $("#seatid").val();
		var tdobj1 =  $("#slot-"+seatid+'-'+stime).attr('time1');
		if(etime == lt){
		   var tdobj2 =  ls;
		}
		else{
		    var tdobj2 =  $("#slot-"+seatid+'-'+etime).attr('time1');
		}
		
	
		$("#tobooked_slot span#start_time").text(tdobj1);
		$("#tobooked_slot span#end_time").text(tdobj2);
		
		var selectvalues = '';
		var serviceids = '';
		$("#service").multiselect("getChecked").map(function(){
		    if(selectvalues == ''){
			selectvalues = this.title;
			serviceids = this.value;
		    }
		    else{
			selectvalues  = selectvalues+','+this.title;
			serviceids = serviceids+','+this.value;
		    }
		});
		$("#custservices").html(selectvalues);
		$("#slctd_services").val(serviceids);
		
		$("#customerDialog").dialog("open");
		return false;
		//alert(tdobj1+"   "+tdobj2);
	    });
	
	$('.appbook_table td.empty_slots').live("hover",getselectedslot);
	$('.appbook_table td.empty_slots').live("mouseout",resethover);
	
	function getselectedslot(){
	   	$("#starttime").val(0);
		$("#endtime").val(0);
		$("#seatid").val(0);
		
		//alert(0);
	    
		var lt =$('th#table_info').attr('last_timestamp');
		var ft =$('th#table_info').attr('first_timestamp');
		    var duration =  $("#service_duration").val();
		    var rs = parseInt(duration)/15;
		     var str= $("#selectable_slots").val();
		     if(str)$(str).removeClass('selected_slot');
		     var str= '';
		    
		    if(duration != 0){
			var ct =$(this).attr('time');
			var et = ct;
			var st = ct;
			var seat =$(this).attr('seat_id');
			var cs1 = 1;
			var cs2 = 1;
		       for(i=ct;(i<lt && cs1<=rs );){
			    var slotObj = '#slot-'+seat+'-'+i;			
			    if(!$(slotObj).hasClass('booked_slots')){   
				cs1++;
				str +=slotObj+',';
				et = i;
				i=parseInt(i) + 900;
			    }else{
				break;
			    }	
		       }
			rs1= rs-cs1+1;
			for(i=ct-900;(i >ft && cs2<=rs1);){    
			    var slotObj = '#slot-'+seat+'-'+i;
			    
			    if(!$(slotObj).hasClass('booked_slots')){
			       str +=slotObj+',';
				cs2++;
				st = i;
				i=parseInt(i) - 900;
			    }else{
				
				 break;
			    }
    
			 }
			
		       flag = !((et-st+900)-duration*60); //alert(str);
		       et = parseInt(et) + 900;
		       if(flag){
			     $(str).addClass('selected_slot');
			}else{
			    
			    str='';
			}
			//alert(st+' '+et);
			$("#selectable_slots").val(str);
			$("#starttime").val(st);
			$("#endtime").val(et);
			$("#seatid").val(seat);
		    
			
		       /*
		        dialog_input
			 debug= 'ct '+ ct+' et'+et+' st '+st;
		    $('.middle-content').before('<div class="aaa">'+debug+'</div>');
		    */
	       
		    }
	}
	
	
	function disableAllTheseDays(date) {
	    
	    var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
	    //alert(d);
	    for (i = 0; i < disabledDays.length; i++) {
		if($.inArray(y + '-' + (m+1) + '-' + d,disabledDays) != -1) {
		    return [false];
		}
	    }
	    return [true];
	}
	$('#selectdate').datepicker({
		dateFormat: 'yy-mm-dd',
		beforeShowDay: disableAllTheseDays
	});
	
	
    });
    
    function resethover(){
	var str= $("#selectable_slots").val();
	if(str)$(str).removeClass('selected_slot');
	var str= '';
	$("#selectable_slots").val(str);
    }
	
    function getappointmentbook(){
	var date = $("#selectdate").attr('value');
	 // Disable a list of dates
	var widget =  $("#service").multiselect();
	var disabledDays = [<?php echo $disabletoday; ?>];
	if($.inArray(date,disabledDays) == 1) {
	    widget.multiselect("disable");
	}
	else{
	    widget.multiselect("enable");
	}
	
	//alert(date);
	jQuery.ajax({
		url: '<?php echo Yii::app()->request->baseUrl; ?>/users/appointment',     //controller action url
		type: "POST",
		data: {date : date},  
	   
		success: function(resp){    
		    var obj =$(resp);
		    obj.find("#customerDialog").dialog({autoOpen:false});
		    $("#appbook_table").html(obj.find('#appbook_table').html());
		    gethighlightedslots();
		    resethover();
		}
	});
    }
   
    
    
</script>



