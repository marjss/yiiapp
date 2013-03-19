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
		   'header'=> 'taneja',
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
     <?php $tablewidth = 888; ?>
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
		 
		 if($mertimings_attr['sminute'] == '15'){
		     echo "<div class='new-td disable_slots'>&nbsp</div>";
		     $slotcount += 1;
		 }
		 elseif($mertimings_attr['sminute'] == '30'){
		    echo "<div class='new-td disable_slots'>&nbsp</div>";
		    echo "<div class='new-td disable_slots'>&nbsp</div>";
		    $slotcount += 2;
		 }
		 elseif($mertimings_attr['sminute'] == '45'){
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
				     echo "<div class='new-td bottomnew-border booked_slots'  style='width:$width;visibility:hidden;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1." orderid = ".$slots['id'].">Already</div>";
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
					echo "<div class='new-td booked_slots' style='width:$width; visibility:hidden;' id='slot-$seat->id-$key' time=".$key." seat_id=".$seat->id." time1 = ".$time1." orderid = ".$slots['id'].">Already</div>";
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
    <input type="hidden" id = "service_duration" name="service_duration" value = "0">
    <input type="hidden" id = "selectable_slots" name="selectable_slots" value = "0">
     <input type="hidden" id = "updated_order" name="updated_order" value = "0">
     <input type="hidden" id = "updated_custinfo" name="updated_custinfo" value = "0">
	<div class="color-ind">
	    <?php echo CHtml::Image(Yii::app()->request->baseUrl.'/images/whitesmoke.png'); ?><p>Not Available</p>
	   
	      <?php echo CHtml::Image(Yii::app()->request->baseUrl.'/images/darkgreen.png'); ?><p>Booked</p>
	       <?php echo CHtml::Image(Yii::app()->request->baseUrl.'/images/lightyellow.png'); ?><p>Available</p>
	</div>
 
</div>    

<script type="text/javascript">
     
	/*$("#service").bind("multiselectbeforeclose", function(event, ui){
	    gethighlightedslots();
	});
	*/
    $("#calicon").click(function(){
	    $('#selectdate').datepicker('show');
	});
   
    $("#service").multiselect({
	click: function(e){
	    $("#ajaxloader").show();
	    $("#appbook_table").css("opacity","0.5");
	    if( $(this).multiselect("widget").find("input:checked").length >= 0 ){
		gethighlightedslots();
		$("#ajaxloader").hide();
		$("#appbook_table").css("opacity","1");
	    }
	},
    });
    $('a.ui-multiselect-all').live("click",gethighlightedslots);
    $('a.ui-multiselect-none').live("click",gethighlightedslots);
    
    function gethighlightedslots(){
		      //var obj1 =$('#appbook_table tr').find();
	       $('#appbook_table td#appbook_table_seat div.empty_slots').each(function(){
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
		   // alert(resp);
		       $("#service_duration").val(resp);
		     var booked = resp/15;
		     
		     //get the table attributes defined
		     var total_rows =$('th#table_info').attr('total_rows');
		     var total_cols =$('th#table_info').attr('total_cols');
		     var total_minutes =$('th#table_info').attr('total_minutes');
		     var slots = total_minutes/15;
		    
		     $('td#appbook_table_seat').each(function(){
		    var flag = 0;
		       var is_empty =0;
			   var obj =$(this);//$('tr').eq(j).find('td');
			   obj.find('div.new-td').each(function(j){
			      if(j==0){
				     $('.temp').removeClass('temp');
			      }
			     //alert($(this).attr('class'));
			       if($(this).hasClass('empty_slots')){
				   if($(this).hasClass('updated_slots')){
					//$(this).removeClass('updated_slots')
					$(this).css('visibility','visible')
				   }
				   $(this).addClass('temp selectable');
				   
				   is_empty++;
				   if(is_empty==booked){
				       $(this).addClass('highlighted_slot_finish');
				      // $('.temp').eq(0).addClass('highlighted_slot_finish');
				      obj.find('.temp').addClass('highlighted_slot');
				      $('.temp').removeClass('temp');
				       is_empty=0;
				   }
				 // alert(is_empty+' out');
				   
			       }else{
				  // alert(is_empty+' class not');
				   $('.temp').removeClass('temp selectable');
				   is_empty =0;
			       }
			   });
		       
		   });
   
		   }
	       });
     
    }
    
    function UpdatAppointment()
     {
	$('.updateloader').css('display','block');
	    
	   var orderid = $('.updated-space').attr('orderid');
	   var custid = $('.updated-space').attr('customerid');
	   var custinfo = $('.updated-space').attr('customerinfo');
	   $("#updated_order").val(orderid);
	    $("#upcustomer_id").val(custid);
	   $('#updated_custinfo').val(custinfo);
	   //alert(custid)
	   $("#service").multiselect("open");
	   var values = $('.updated-space').attr('booked_services');
	    var upvalues = {};
	   upvalues = values.split(',');
	   var checkvalue = 0;
	  $("#service").multiselect("widget").find(":checkbox").each(function(){
		 checkvalue = $(this).attr('value');
		 for(var i = 0; i<upvalues.length;i++){
		      if(checkvalue == upvalues[i]){
			  //	this.click();
			  $(this).attr('checked','checked');
		      }
		 }
		 /*if($.inArray(checkvalue,upvalues)){
		      alert(checkvalue)
		      this.click();
		 }
		 */
	  });
	    //}).load('<?php //echo Yii::app()->request->baseUrl; ?>/appointmentbook/changestatus/'+orderid);
	    
	    $('.updated-space').css('display','none');  
	    gethighlightedslots();	 
     }
	
    
    $(document).ready(function() {
	
	//$(".booked-space").trigger('mouseenter');
	
	
	var today = $("#selectdate").attr('value');
	 // Disable a list of dates
	var widget =  $("#service").multiselect();
	var disabledDays = [<?php echo $disabletoday; ?>];
	if($.inArray(today,disabledDays) == 1) {
	  
	    widget.multiselect("disable");
	}
	$('#appbook_table td#appbook_table_seat div.booked_slots').live("click",function(){
	  
		var today = $("#selectdate").attr('value');
		var orderid = $(this).attr('orderid');
		var dailog= $('<div id="booked_dialog_wrapper"></div>');
		$('body').append(dailog);
		$("#booked_dialog_wrapper").load('<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/getbookedorder/'+orderid).dialog({
		    autoOpen:true,
		      height: 'auto',
                      width: 450,
		      modal: true,
		      title: 'Booking with Customer',
		  buttons: {
			"Delete":function(){
			    if(confirm("Are you sure you want to delete this appointment?")){
				//$(this).load('<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/cancelorder/'+orderid);
				//$(this).dialog("close");
				$('#booked_dialog_wrapper').remove();
				$("#ajaxloader").show();
				$(".appbook").css("opacity","0.5");
				$.ajax({
				    url: '<?php echo Yii::app()->request->baseUrl; ?>/users/appointment',     //controller action url
				    type: "POST",
				    data: {date : today,orderid:orderid,operation:'delete'},  
				    success:function(resp){
					var obj =$(resp);
					$("#appointmenttable").html(obj.find('#appointmenttable').html());
					$(this).dialog("destroy");
					
					$("#ajaxloader").hide();
					$(".appbook").css("opacity","1");
				    }    
				});
			    }
			   
			}/*,
		    	"Update":function(){
			    if(confirm("Are you sure you want to update this appointment?")){
				//$(this).load('<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/cancelorder/'+orderid);
				//$(this).dialog("close");
				$("#ajaxloader").show();
				$(".appbook").css("opacity","0.5");
				$.ajax({
				    url: '<?php echo Yii::app()->request->baseUrl; ?>/users/appointment',     //controller action url
				    type: "POST",
				    data: {date : today,orderid:orderid,operation:'update'},  
				    success:function(resp){
					var obj =$(resp);
					$("#appointmenttable").html(obj.find('#appointmenttable').html());
					$(this).dialog("destroy");
					$('#booked_dialog_wrapper').remove();
					$(".new-td p[title]").qtip({'position':{'corner':{'target':'rightMiddle','tooltip':'leftTop'}},'show':{'when':{'event':'mouseover'},'effect':{'length':300}},'hide':{'when':{'event':'mouseout'},'effect':{'length':300}},'style':{'color':'black','name':'blue','border':{'width':7,'radius':5}}});
					$("#ajaxloader").hide();
					$(".appbook").css("opacity","1");
					UpdatAppointment();
				    }    
				});
			    }
			}*/
			
		    },
		  close:function(){
			$(this).dialog("destroy");
			$('#booked_dialog_wrapper').remove();
		    }  
		    });
	 });
	
	$('.updated-space').live('click',function(){
	    UpdatAppointment();
	  });
	
	
	
	$('#appbook_table td#appbook_table_seat div.selected_slot').live("click",function(){
	       var uporder = $("#updated_order").val();
	       $("#lastupdate_order").val(uporder); 
	       var lt =$('th#table_info').attr('last_timestamp');
	       var ls =$('th#table_info').attr('last_timestring');
		if(uporder == 0){
		    var stime= $("#starttime").val();
		    var etime= $("#endtime").val();	   
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
			    selectvalues  = selectvalues+', '+this.title;
			    serviceids = serviceids+','+this.value;
			}
		    });
		    $("#custservices").html(selectvalues);
		    $("#slctd_services").val(serviceids);
		    $("#customerDialog").dialog("open");
		}
		else{
		   // $("#customerDialog").dialog("destroy");
		    var stime= $("#updatestime").val();
		    var etime= $("#updateendtime").val();	   
		    var seatid = $("#seat_id").val();
		    var tdobj1 =  $("#slot-"+seatid+'-'+stime).attr('time1');
		    var customerinfo =  "Customer Info : "+$('#updated_custinfo').val();
		    if(etime == lt){
		       var tdobj2 =  ls;
		    }
		    else{
			var tdobj2 =  $("#slot-"+seatid+'-'+etime).attr('time1');
		    }
		    
	    
		    $("#update_slot span#upstart_time").text(tdobj1);
		    $("#update_slot span#upend_time").text(tdobj2);
		    
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
		    $("#upcustservices").html(selectvalues);
		    $("#update_services").val(serviceids);
		     $("#customerinfotext").html(customerinfo);
		  
		    
		   $("#updateDialog").dialog("open");
		}
		
		return false;
		//alert(tdobj1+"   "+tdobj2);
	    });
	
	$('#appbook_table td#appbook_table_seat div.empty_slots').live("hover",getselectedslot);
	//$('#appbook_table td#appbook_table_seat div.empty_slots').live("mouseout",resethover);
	
	function getselectedslot(){
	  var uporder = $("#updated_order").val();
	  //alert(uporder);
	 
	   	$("#starttime").val(0);
		$("#endtime").val(0);
		$("#seatid").val(0);
	 
	       //alert(uporder);
	       $("#updatestime").val(0);
	       $("#updateendtime").val(0);
	       $("#seat_id").val(0);
	  
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
			if(uporder == 0){
			      $("#starttime").val(st);
			      $("#endtime").val(et);
			      $("#seatid").val(seat);
			}
			else{
			     //alert(uporder);
			     $("#updatestime").val(st);
			     $("#updateendtime").val(et);
			     $("#seat_id").val(seat);
			}
			
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
	var d =  new Date();
	var today =
	  d.getFullYear() + "/" +
	  ("0" + (d.getMonth() + 1)).slice(-2)
	   + "/" +("0" + d.getDate()).slice(-2);
	  
	 // Disable a list of dates
	var widget =  $("#service").multiselect();
	var disabledDays = [<?php echo $disabletoday; ?>];
	if($.inArray(date,disabledDays) == 1 || Date.parse(today) > Date.parse(date)) {
	    widget.multiselect("disable");
	}
	else{
	    widget.multiselect("enable");
	}
	$("#ajaxloader").show();
	$(".appbook").css("opacity","0.5");
	//alert(date);
	jQuery.ajax({
		url: '<?php echo Yii::app()->request->baseUrl; ?>/users/appointment',     //controller action url
		type: "POST",
		data: {date : date},  
		
		success: function(resp){    
		    var obj =$(resp);
		    obj.find("#customerDialog").dialog({autoOpen:false});
		    $("#appointmenttable").html(obj.find('#appointmenttable').html());
		    $(".new-td p[title]").qtip({'position':{'center':{'target':'rightMiddle','tooltip':'leftTop'}},'show':{'when':{'event':'mouseover'},'effect':{'length':300}},'hide':{'when':{'event':'mouseout'},'effect':{'length':300}},'style':{'color':'black','name':'blue','border':{'width':7,'radius':5}}});
		    gethighlightedslots();
		    resethover();
		    
		    $("#ajaxloader").hide();
		    $(".appbook").css("opacity","1");
		}
	});
    }
    
    
</script>



