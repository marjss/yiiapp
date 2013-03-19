<div class="merchant-services">
		<?php $categoryservice = $this->getCategoryService()?>
		<?php if(count($categoryservice) > 0):?>
		<div class="ui-widget-header ui-corner-all ui-multiselect-header ui-helper-clearfix">
				<ul class="ui-helper-reset">
						<!-- <li>
								<a href="javascript: void(0);" class="ui-multiselect-all">
										<span class="ui-icon ui-icon-check"></span><span>Check all</span>
								</a>
						</li> -->
						<li>
								<a href="javascript: void(0);" class="ui-multiselect-none">
										<span class="ui-icon ui-icon-closethick"></span><span>Uncheck all</span>
								</a>
						</li>
						<li class="ui-multiselect-close">
								<a class="ui-multiselect-close" href="javascript: void(0);">
										<span class="service-done">Done</span></a>
						</li>
				</ul>
		</div>
		<div class="mservices" id="m-service">
                    <div class="errors"> You cannot select more than available time</div>
		<?php foreach($categoryservice as $cat_service):?>
				<?php $cat_id	=	$cat_service->id;?>
				
				<?php $services	=	$this->getMerchantServices(Yii::app()->user->id, $cat_id);?>
				<?php $servicecounter = 0;?>
				<?php //echo "<pre>"; print_r($services);die;?>
				<?php if($services):?>
				<div class="category-service"><?php echo $cat_service->title?></div>
				<ul>
				<?php foreach($services as $service):?>
						<li>
								<div class="service-label">
										<span class="service"><?php echo $service->name?></span>
										<span class="service-detail">
												<?php
												if($service->duration >= 60)
												{
														$duration = ($service->duration / 60). ' hrs';
												}
												else
												{
														$duration = $service->duration. ' mins';
												}
												?>
												<?php echo $duration.' / Rs. '.$service->price;?>
										</span>
										<?php $label = $service->name.' ('.$service->duration.') Rs '.$service->price;?>
										<?php //echo $label;?>
								</div>
								<div class="service-input">
										<input type="checkbox" class="check-service" title="<?php echo $label?>" id="<?php echo $service->id?>" value="<?php echo $service->duration?>" />
								</div>
								<div class="clear"></div>
						</li>
						<?php $servicecounter++;?>
				<?php endforeach;?>
				</ul>
				<?php endif;?>
		<?php endforeach;?>
				
		</div>
		<?php endif;?>
		
</div>
<input type="hidden" value="" name="selectable_slots" id="selectable_slots">
<input type="hidden" id = "updated_order" name="updated_order" value = "0">

<script type="text/javascript">
jQuery(document).ready(function() {
                jQuery('.mservices errors').css('visibility') == 'hidden';
		var serviceselected 	= 	0;
		var serviceduration	=	0;
		var slots				=	0;
		var booked				=	0;
		var selectvalues 		= 	'';
		var serviceids 		= 	'';
		jQuery("#calicon").click(function(){
                    
				jQuery('#selectdate').datepicker('show');
		});
		jQuery(".merchant-services a.ui-multiselect-all").live("click",function(){
                               
				resetgrid();
				
				jQuery('input.check-service').each(function () {
                                   
						jQuery(this).attr('checked', true);
						serviceselected	=	jQuery("input.check-service:checked").length;
                                                if(jQuery(this).is(':checked'))
						{
                                                   
								jQuery(this).parents('li').addClass('setected');
								jQuery('a#service-select').html(serviceselected+' service(s) selected');
						}
						else
						{ 
								jQuery(this).parents('li').removeClass('setected');
								if(serviceselected == 0)
										jQuery('a#service-select').html('-- Select Services --<span></span>');
								else
										jQuery('a#service-select').html(serviceselected+' service(s) selected');
						}
						serviceduration 	= 	0;
						selectvalues 		= 	'';
						serviceids			=	'';
						jQuery('input.check-service:checked').each(function () {
								serviceduration 	= parseInt(jQuery(this).val()) + parseInt(serviceduration);
                                                               
								if(selectvalues == ''){
										selectvalues		= jQuery(this).attr('title');
										serviceids			= jQuery(this).attr('id');
								}
								else
								{
										selectvalues		= selectvalues +", "+ jQuery(this).attr('title');
										serviceids			= serviceids +", "+ jQuery(this).attr('id');
								}
								
						});
						
						
						booked	=	Math.floor(serviceduration/15);
						
						if(booked > 0)
						{
								jQuery('.new-td').addClass('selectable highlighted_slot');
						}
						else
						{
								jQuery('.new-td').removeClass('selectable highlighted_slot');
						}
						
						//
						
						jQuery('td#appbook_table_seat').each(function(){
								var flag 		= 	0;
								var is_empty 	=	0;
								var obj 			=	jQuery(this);
								obj.find('div.new-td').each(function(j){
										if(j==0){
												jQuery('.temp').removeClass('temp');
										}
										
										if(jQuery(this).hasClass('empty_slots'))
										{
												if(jQuery(this).hasClass('updated_slots')){
														jQuery(this).css('visibility','visible')
												}
												
												jQuery(this).addClass('temp selectable');
											
												is_empty++;
												
												if(is_empty==booked){
														jQuery(this).addClass('highlighted_slot_finish');
														obj.find('.temp').addClass('highlighted_slot');
														jQuery('.temp').removeClass('temp');
														is_empty		=	0;
												}
											
										}
										else
										{
												if(!jQuery(this).hasClass('booked_slots'))
												{
														jQuery(this).addClass('empty_slots')
														
												}
												
												jQuery('.temp').removeClass('temp selectable');
												is_empty 	=	0;
										}
								});
								 
						});
						
				});
		});
		jQuery(".merchant-services a.ui-multiselect-none").live("click",function(){
				resetgrid();
		});
		jQuery(".merchant-services a.ui-multiselect-close").live("click",function(){
				
				jQuery("a#service-select").click();
		});
		jQuery('.check-service').click(function(){
				
				serviceselected	=	jQuery("input.check-service:checked").length;
				if(jQuery(this).is(':checked'))
				{ 
						jQuery(this).parents('li').addClass('setected');
						jQuery('a#service-select').html(serviceselected+' service(s) selected');
				}
				else
				{ 
						jQuery(this).parents('li').removeClass('setected');
						if(serviceselected == 0)
								jQuery('a#service-select').html('-- Select Services --<span></span>');
						else
								jQuery('a#service-select').html(serviceselected+' service(s) selected');
				}
				serviceduration 	= 	0;
				selectvalues 		= 	'';
				serviceids			=	'';
				jQuery('input.check-service:checked').each(function () {
						serviceduration 	= parseInt(jQuery(this).val()) + parseInt(serviceduration);
                                                 
						if(selectvalues == ''){
								selectvalues		= jQuery(this).attr('title');
								serviceids			= jQuery(this).attr('id');
						}
						else
						{
								selectvalues		= selectvalues +", "+ jQuery(this).attr('title');
								serviceids			= serviceids +", "+ jQuery(this).attr('id');
						}
						
				});
				if(serviceduration>= '600'){
                                    alert("You cannot select more than available time.");
                                    jQuery('.errors').css("visibility", "visible");
                                    var lastChecked = $(this);
                                    serviceselected = serviceselected-1;
                                    jQuery('a#service-select').html(serviceselected+' service(s) selected');
                                    jQuery(lastChecked).attr( 'checked', false );
                                    jQuery(this).parents('li').removeClass('setected');
                                    serviceduration 	=  parseInt(serviceduration) - parseInt(jQuery(lastChecked).val());
                                     }   
				
				booked	=	Math.floor(serviceduration/15);
				
				if(booked > 0)
				{
						jQuery('.new-td').addClass('selectable highlighted_slot');
				}
				else
				{
						jQuery('.new-td').removeClass('selectable highlighted_slot');
				}
				
				//
				
				jQuery('td#appbook_table_seat').each(function(){
						var flag 		= 	0;
						var is_empty 	=	0;
						var obj 			=	jQuery(this);
						obj.find('div.new-td').each(function(j){
								if(j==0){
										jQuery('.temp').removeClass('temp');
								}
								
								if(jQuery(this).hasClass('empty_slots'))
								{
										if(jQuery(this).hasClass('updated_slots')){
												jQuery(this).css('visibility','visible')
										}
										
										jQuery(this).addClass('temp selectable');
									
										is_empty++;
										
										if(is_empty==booked){
												jQuery(this).addClass('highlighted_slot_finish');
												obj.find('.temp').addClass('highlighted_slot');
												jQuery('.temp').removeClass('temp');
												is_empty		=	0;
										}
									
								}
								else
								{
										if(!jQuery(this).hasClass('booked_slots'))
										{
												jQuery(this).addClass('empty_slots')
												
										}
										
										jQuery('.temp').removeClass('temp selectable');
										is_empty 	=	0;
								}
						});
						 
				});
		
		});		
		jQuery('#appbook_table td#appbook_table_seat div.empty_slots').live("hover",function(){
				var uporder = jQuery("#updated_order").val();
				//alert(uporder);
				jQuery("#starttime").val(0);
				jQuery("#endtime").val(0);
				jQuery("#seatid").val(0);
			 
				//alert(uporder);
				jQuery("#updatestime").val(0);
				jQuery("#updateendtime").val(0);
				jQuery("#seat_id").val(0);
			  
				//alert(0);
				 
				var lt 			=	jQuery('th#table_info').attr('last_timestamp');
				var ft 			=	jQuery('th#table_info').attr('first_timestamp');
				var duration 	=  serviceduration; /*$("#service_duration").val();*/
				var rs 			= 	booked ; /*parseInt(duration)/15;*/
				var str			= 	jQuery("#selectable_slots").val();
				if(str)jQuery(str).removeClass('selected_slot');
				var str			= 	'';
					 
				if(duration != 0)
				{
						var ct 		=	jQuery(this).attr('time');
						var et 		= 	ct;
						var st 		= 	ct;
						var seat 	=	jQuery(this).attr('seat_id');
						var cs1 		= 	1;
						var cs2 		= 	1;
						for(i=ct;(i<lt && cs1<=rs );)
						{
								var slotObj 	= 	'#slot-'+seat+'-'+i;			
								if(!jQuery(slotObj).hasClass('booked_slots')){
										cs1++;
										str 			+=	slotObj+',';
										et 			= 	i;
										i				=	parseInt(i) + 900;
								}else{
										break;
								}	
						}
						rs1		= 	rs-cs1+1;
						for(i=ct-900;(i >ft && cs2<=rs1);)
						{    
								var slotObj 		= 	'#slot-'+seat+'-'+i;
								if(!jQuery(slotObj).hasClass('booked_slots')){
										str 			+=	slotObj+',';
										cs2++;
										st 			= 	i;
										i				=	parseInt(i) - 900;
								}else{
										break;
								}
				 
						}
					
						flag 		= 	!((et-st+900)-duration*60); //alert(str);
						et 		= 	parseInt(et) + 900;
						if(flag){
								jQuery(str).addClass('selected_slot');
						}else{
								str	=	'';
						}
						//alert(st+' '+et);
						
						jQuery("#selectable_slots").val(str);
						
						if(uporder == 0){
								jQuery("#starttime").val(st);
								jQuery("#endtime").val(et);
								jQuery("#seatid").val(seat);
						}
						else{
							  //alert(uporder);
							  jQuery("#updatestime").val(st);
							  jQuery("#updateendtime").val(et);
							  jQuery("#seat_id").val(seat);
						}
					
				}
		});
		
		
		
		
		
		jQuery('#appbook_table td#appbook_table_seat div.selected_slot').live("click",function(){
				
				if(jQuery("#appservicebox .mservices-wrapper").css('visibility') == 'visible')
						jQuery("a#service-select").click();
						
				var uporder 	= 	jQuery("#updated_order").val();
				jQuery("#lastupdate_order").val(uporder); 
				var lt 			=	jQuery('th#table_info').attr('last_timestamp');
				var ls 			=	jQuery('th#table_info').attr('last_timestring');
				if(uporder == 0)
				{
						var stime	= 	jQuery("#starttime").val();
						var etime	= 	jQuery("#endtime").val();	   
						var seatid 	= 	jQuery("#seatid").val();
						var tdobj1 	=  jQuery("#slot-"+seatid+'-'+stime).attr('time1');
						if(etime == lt){
							var tdobj2 	= 	ls;
						}
						else{
							var tdobj2 	= 	jQuery("#slot-"+seatid+'-'+etime).attr('time1');
						}
				 
			 
						jQuery("#tobooked_slot span#start_time").text(tdobj1);
						jQuery("#tobooked_slot span#end_time").text(tdobj2);
						
						
						jQuery("#custservices").html(selectvalues);
						jQuery("#slctd_services").val(serviceids);
						jQuery("#customerDialog").dialog("open");
				}
				else
				{
						var stime			= 	jQuery("#updatestime").val();
						var etime			= 	jQuery("#updateendtime").val();	   
						var seatid 			= 	jQuery("#seat_id").val();
						var tdobj1 			=  jQuery("#slot-"+seatid+'-'+stime).attr('time1');
						var customerinfo 	=  "Customer Info : "+$('#updated_custinfo').val();
						if(etime == lt){
								var tdobj2 		= 	ls;
						}
						else{
								var tdobj2 		= 	jQuery("#slot-"+seatid+'-'+etime).attr('time1');
						}
				 
			 
						jQuery("#update_slot span#upstart_time").text(tdobj1);
						jQuery("#update_slot span#upend_time").text(tdobj2);
				 
						
						
						jQuery("#upcustservices").html(selectvalues);
						jQuery("#update_services").val(serviceids);
						jQuery("#customerinfotext").html(customerinfo);
						jQuery("#updateDialog").dialog("open");
				}
				
				// Blank content of customer lookup
				
				if(document.getElementById("newcustomer").style.display == 'block')
				{
						jQuery("#newcustomer #customer_name").val('');
						jQuery("#newcustomer #customer_contact_no").val('');
						jQuery("#newcustomer #customer_email").val('');
						jQuery("#newcustomer").hide();
						jQuery("#customerautocomplete").show();
						jQuery("#customer_autocomplete").val('');
						jQuery("#bookbutton1").hide();
						jQuery("#newclientbutton").show();
						jQuery("#bookbutton").hide();
				}
				else
				{
						jQuery("#customer_autocomplete").val('');
						jQuery("#bookbutton1").hide();
						jQuery("#bookbutton").hide();
						jQuery("#newclientbutton").show();
				}
		
				return false;
		});
		
		jQuery('#appbook_table td#appbook_table_seat div.booked_slots').live("click",function(){
				var today 		= jQuery("#selectdate").attr('value');
				var orderid 	= jQuery(this).attr('orderid');
				var cancelid	= jQuery(this).attr('id');
				var dailog		= jQuery('<div id="booked_dialog_wrapper"></div>');
				jQuery('body').append(dailog);
				jQuery("#booked_dialog_wrapper").load('<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/getbookedorder/'+orderid).dialog({
					autoOpen:true,
					height: 'auto',
					width: 450,
					modal: true,
					title: 'Booking with Customer',
					buttons: {
						"Cancel Appointment":function(){
							if(confirm("Are you sure you want to delete this appointment?")){
								
								jQuery('#booked_dialog_wrapper').remove();
								//jQuery("#ajaxloader").show();
								jQuery(".appbook").css("opacity","0.5");
								jQuery.ajax({
									url: '<?php echo Yii::app()->request->baseUrl; ?>/users/deleteappointment',     //controller action url
									type: "POST",
									data: {date : today,orderid:orderid, cancelid: cancelid},  
									success:function(resp){
										var obj =	jQuery.parseJSON(resp);
										if(obj.result == 'success')
										{
												jQuery('#'+obj.cancelid).html('');
												var selectedblocks 	= 	parseInt(obj.totaltime) / 15;
												var cancelledbolk		=	obj.cancelid;
												var cancelblkarray	=  cancelledbolk.split("-");
												var starttime			= 	parseInt(cancelblkarray[2]);
												var seatid				=	parseInt(cancelblkarray[1]);
												var loopinnertime		=	starttime;
												var oneslottime		=	900;
												for(looptime = 0; looptime < selectedblocks; looptime++)
												{
														
														if(looptime != 0)
														{
															  var customtooltip  = "#slot-"+seatid+"-"+loopinnertime;
															  jQuery("#slot-"+seatid+"-"+loopinnertime).css('visibility','visible');
															  var time1 			 = jQuery(customtooltip).attr('time1');
															  var newajaxclass 	 = 'ajax'+loopinnertime;
															  jQuery(customtooltip).addClass(newajaxclass);
															  
														}
														jQuery("#slot-"+seatid+"-"+loopinnertime).html('');
														jQuery("#slot-"+seatid+"-"+loopinnertime).removeClass('booked_slots');
														jQuery("#slot-"+seatid+"-"+loopinnertime).addClass('empty_slots');
														loopinnertime = loopinnertime +  oneslottime;
														var time2 = jQuery("#slot-"+seatid+"-"+loopinnertime).attr('time1');
													 
												}
												//empty_slots
												jQuery(".appbook").css("opacity","1");
										}
									 }    
								});
							}
					
						}
				
					},
					close:function(){
						jQuery(this).dialog("destroy");
						jQuery('#booked_dialog_wrapper').remove();
					}  
				});
		});
		
		// If clicked on Select Services link
		jQuery('a#service-select').click(function(){
				jQuery('.errors').css("visibility", "hidden");
				if(jQuery('.mservices-wrapper').css("visibility") == "hidden")
                                    
						jQuery('.mservices-wrapper').css("visibility", "visible");
                                                
                                    
				else
						jQuery('.mservices-wrapper').css("visibility" , "hidden");
		});
		
		
});

function resetgrid()
{
		
		jQuery('input.check-service').attr( 'checked', false );
		jQuery('.new-td').removeClass('selectable')
		jQuery('.new-td').removeClass('highlighted_slot');
		serviceselected	=	0;
		serviceduration 	= 	0;
		selectvalues 		= 	'';
		serviceids			=	'';
		booked				=	0;
		jQuery(".new-td").removeClass("empty_slots");
		jQuery(".new-td").removeClass("selectable");
		jQuery('.new-td').removeClass('selected_slot');
		jQuery("a#service-select").html("-- Select Services --<span></span>");
		jQuery("#m-service ul li").removeClass("setected");
		
		
}
</script>