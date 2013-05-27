<style>
    label.error{ color: red;
     float: left;
     width: 398px !important;
      margin-top: -10px;
    }
</style>
 
  <?php
     $cs = Yii::app()->getClientScript();
     //$cs->registerCoreScript('jquery');
     $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.form.js');
     $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.validate.js');
	  
       $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'customerDialog',
	       'cssFile'=>Yii::app()->request->baseUrl.'/css/jquery-ui.css',
                'options'=>array(
                    'title'=>'Customer lookup',
                    'autoOpen'=>false,
		     'closeOnEscape' => true,
                    'modal'=>'true',
                    'width'=>'484',
                    'height'=>'auto',
		    //'buttons'=>array('Cancel'=>'js:function(){$(this).dialog("close")}')
                ),
            ));
       
       $form1=$this->beginWidget('CActiveForm', array(
		'id'=>'booking-form',
                //'action'=>Yii::app()->request->baseUrl.'/evaluation/MyEvaluation/'.$_REQUEST['id'],
		'enableAjaxValidation'=>false,
                'enableClientValidation'=>true,
	       'htmlOptions'=>array(
		    'onsubmit'=>"return false;",/* Disable normal form submit */
		    'onkeypress'=>" if(event.keyCode == 13){ send(); } " 
	       ),
	    ));
       
    ?>
    <?php echo $form1->errorSummary($customerform);?>
    
   
    <br />
    <div class="dialog_input">
	  <input type="hidden" id = "starttime" name="starttime" value = "0">
	  <input type="hidden" id = "endtime" name="endtime" value = "0">
	  <input type="hidden" id = "seatid" name="seatid" value = "0">
	  <input type="hidden" id = "customerid" name="customerid" value = "0">
	  <input type="hidden" id = "slctd_services" name="slctd_services" value = "0">	
	   <div id="customerautocomplete">
	       <?php 
		    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			 'attribute'=>'customerinfo',
			 'model'=>$model,
			 'sourceUrl'=>array('users/findCustomerinfo'),
			 'options'=>array(
			     'minLength'=>'2',
			    
			     'select'=>'js: function(e,u){
								jQuery("#customerid").val(u.item["id"]);
								getbookingui();
							  }',
			     /*'search' => 'js:function(){
									 $("#loading").show();
				 
								 }',*/
					 'complete' => 'js:function(){
										  
										  }',

			      'open' =>'js:function(event, ui){
								$("ul.ui-autocomplete li a").each(function(){
								var htmlString = $(this).html().replace(/,/g, "<br>");
								htmlString = htmlString.replace(/,/g, "<br>");
								$(this).html(htmlString);
								});
                    }',
			      ),
			 'htmlOptions'=>array(
									 'size'=>45,
									 'maxlength'=>45,
									 'class'=>'customer_field',
									 'id'=>'customer_autocomplete',
								),
		      ));
		  
	       ?>
	       <div id="loading" class="loadingimg" style="display:none;"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/loading.gif" /></div>
	       <?php
		    $rightimg = CHtml::Image(Yii::app()->request->baseUrl.'/images/addperson.png');
                    echo CHtml::link($rightimg,'javascript:void(0)',array('onclick'=>'return getnewclientui()','id'=>"addcustomerimg"));
	        ?>
	   </div>
	       <div id = "newcustomer" style="display:none;width: 420px;">
		    <?php echo $form1->labelEx($customerform,'customer_name'); ?>
		    <?php echo $form1->textField($customerform,'customer_name', array('size'=>40,'maxlength'=>150,'id'=>'customer_name','class'=>'customer_field required',)) ?>
		     <?php echo $form1->error($customerform,'customer_name'); ?>
		    <br />
		    <?php echo $form1->labelEx($customerform,'customer_contact_no'); ?>
		    <?php echo $form1->textField($customerform,'customer_contact_no', array('size'=>40,'maxlength'=>150,'id'=>'customer_contact_no','class'=>'customer_field required uniqueMobile','number'=>'true','minlength'=>10,'required'=>'true')) ?>
		    <?php echo $form1->error($customerform,'customer_contact_no'); ?>
		    <br />
		    <?php echo $form1->labelEx($customerform,'customer_email'); ?>
		    <?php echo $form1->textField($customerform,'customer_email', array('size'=>40,'maxlength'=>150,'id'=>'customer_email','class'=>'customer_field ','email'=>'true')) ?>
		     <?php echo $form1->error($customerform,'customer_email'); ?>
		     <br />
	       </div>
	  <?php //echo $form1->textField($form,'customer_name', array('size'=>40,'maxlength'=>150,'id'=>'customer_id','class'=>'customer_field')) ?>
	
<div id="tobooked_slot">Booking time: <span id="start_time"></span> to <span id="end_time"></span></div>
    <div class="double-process" id="custservices"></div>
    <div class="check">
    	<span>Intimate Customer via: </span>
	 <?php //echo CHtml::checkBox('sms','sms', array('class'=>'checkbox require-one', 'checked'=>'checked','value'=>1, 'uncheckValue'=>NULL));?>
	<input type="checkbox" value="sms" class="checkbox smsemail "  id="sendsms" name="sms" />
        <label>SMS</label>
        
         <?php //echo CHtml::checkBox('email','email', array('class'=>'checkbox require-one', 'checked'=>'checked','value'=>1, 'uncheckValue'=>NULL));?>
	 <input type="checkbox" value="email" class="checkbox smsemail " checked='checked' id="sendsmsemal" name="smsemail" />
        <label>Email</label>
        <div class="cl"></div>
        
    </div>
	  <input type="button" value="Cancel" class="lookup-button" onclick = "return cancelpopup()"/>
	  <!--<input type="button" value="Time Off" class="lookup-button" /> -->
	  <input type="button" value="+New Client" class="lookup-button" onclick="return getnewclientui()" id="newclientbutton" />
	  <input type="submit" value="Book" class="lookup-button" id="bookbutton" style="display:none;" onclick="js:send();"/>
	  <input type="button" value="Book" class="lookup-button" onclick="return afterValidates()" id="bookbutton1" style="display:none;" />
   </div>      
       
       
<?php $this->endWidget(); ?>

 <input type="hidden" id = "newclientpopup" name="newclientpopup" value = "0">

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>



<script type="text/javascript">
   
     function getnewclientui()
     {
		  $('#customerautocomplete').css('display','none');
		  $('#newcustomer').css('display','block');
		  $('#bookbutton').css('display','block');
		  $('#bookbutton1').css('display','none');
		  $("#newclientbutton").css('display','none');
		  $("#newclientpopup").val(1);
		  $("#customerid").val(0);
     }
     function getbookingui()
     {
		  //$('#Mercustomers_customerinfo').css('display','none');
		  $("#newclientbutton").css('display','none');
		  if($("#newclientpopup").val() == 1){
				 $('#bookbutton').css('display','block');
				 $('#bookbutton1').css('display','none');
		  }
		  else{
				 $('#bookbutton').css('display','none');
				 $('#bookbutton1').css('display','block');
		  }
     }
     
     function  cancelpopup(){
		  if($("#newclientpopup").val() == 1){
			$('#customerautocomplete').css('display','block');
				$('#newcustomer').css('display','none');
				$('#bookbutton').css('display','none');
				$('#bookbutton1').css('display','none');
				$("#newclientbutton").css('display','block');
				$("#newclientpopup").val(0);
		  }
		  else{
				$('#bookbutton').css('display','none');
				$('#bookbutton1').css('display','block');
				$('#customerDialog').dialog('close');
		  }
		  $("#customerid").val(0);
		  $(".errorSummary").css('display','none');
     }
    $('#customer_contact_no').change(function(){
         $('#CustomerForm_customer_contact_no_em_').css('display','none');  
    })
     function send()
	  {
                //removed validation on urgent basis
		  jQuery("#booking-form").validate()
		  var validornot = jQuery("#booking-form").valid();
//                   var validornot = true;
		  if(validornot)
		  {
				 
				if(checkmobile()) //removed validation
				{ 
                                    
					 /*if(checkemail())
					 {*/
						  var url = "<?php echo Yii::app()->request->baseUrl; ?>/users/bookappointment";
						  //jQuery("#ajaxloader").show();
						  jQuery(".appbook").css("opacity","0.5");
						  
						  var starttime			=	jQuery('#starttime').val();
						  var endtime			=	jQuery('#endtime').val();
						  var seatid			=	jQuery('#seatid').val();
						  var customerid		=	jQuery('#customerid').val();
						  var slctd_services		=	jQuery('#slctd_services').val();
						  var customer_name		=	jQuery('#customer_name').val();
						  var customer_contact_no	=	jQuery('#customer_contact_no').val();
						  var customer_email		=	jQuery('#customer_email').val();
						  var sms 			= 	jQuery('#sendsms').val();
						  var smsemail			=	jQuery("#sendsmsemal").val();
						  
						  var url = "<?php echo Yii::app()->request->baseUrl; ?>/users/bookappointment";
						  jQuery.post( url, { starttime: starttime , endtime: endtime, seatid: seatid, customerid: customerid, slctd_services: slctd_services, customer_name: customer_name, customer_contact_no: customer_contact_no, customer_email: customer_email, sms: sms, smsemail: smsemail},
								function( data ) {
									 //jQuery("#ajaxloader").hide();
					 
									 var obj 			= 	jQuery.parseJSON(data);
									 var endtime		=	parseInt(obj.endtime);
									 var starttime		=	parseInt(obj.starttime);
									 var timediff		=	(endtime - starttime)/ 675;
									 var oneslottime	=	parseInt(900);
									 var bookedblocks =	(endtime - starttime)/900;
									 var blockheight	=	bookedblocks * 19;
									 var loopinnertime	=	starttime;
									 
									 var totalminbooked	=	bookedblocks * 15;
									 var totalamount		=	obj.totalamounts;
									 for(looptime = 0; looptime < bookedblocks; looptime++)
									 {
										  if(looptime == 0)
										  {
												var time1 = jQuery("#slot-"+seatid+"-"+loopinnertime).attr('time1');
												var newajaxclass 	 = 'ajax'+loopinnertime;
												jQuery("#slot-"+seatid+"-"+loopinnertime).addClass(newajaxclass);
										  }
										 if(looptime != 0)
										 {
												var customtooltip  = "#slot-"+seatid+"-"+loopinnertime;
												jQuery("#slot-"+seatid+"-"+loopinnertime).css('visibility','hidden');
												var time2 			 = jQuery(customtooltip).attr('time1');
												
												
										 }
										  jQuery("#slot-"+seatid+"-"+loopinnertime).attr("orderid",obj.orderid);
										  jQuery("#slot-"+seatid+"-"+loopinnertime).removeClass('empty_slots');
										  jQuery("#slot-"+seatid+"-"+loopinnertime).addClass('booked_slots');
										  loopinnertime = loopinnertime +  oneslottime;
										 
										  
									 }
									 
									 var tooltip			=	time1+' - '+ time2 +' <br>'+obj.tooltip;
									 var htnmltoblock		=	'<div style=" height:'+blockheight+'px;" class="booked-space"><p title="'+tooltip+'">'+obj.customername+'<br>'+obj.contactno+'</p></div>';
									 jQuery("#slot-"+seatid+"-"+obj.starttime).load().html(htnmltoblock);
									 resetgrid();
									 
									 
									 jQuery("."+newajaxclass+" p[title]").qtip({'position':{'corner':{'target':'rightMiddle','tooltip':'leftTop'}},'show':{'when':{'event':'mouseover'},'effect':{'length':300}},'hide':{'when':{'event':'mouseout'},'effect':{'length':300}},'style':{'color':'black','name':'blue','border':{'width':7,'radius':5}}});
									 //jQuery(customtooltip).qtip({'position':{'corner':{'target':'rightMiddle','tooltip':'leftTop'}},'show':{'when':{'event':'mouseover'},'effect':{'length':300}},'hide':{'when':{'event':'mouseout'},'effect':{'length':300}},'style':{'color':'black','name':'blue','border':{'width':7,'radius':5}}});
									 jQuery(".appbook").css("opacity","1");
									 jQuery('#customerDialog').dialog('close');
									 
								}
						  );
					 /*}
					 else
					 {
						  $.validator.addMethod("uniqueEmail", function(value, element) { }, "Email is already taken.");
					 }*/
                                //removed validation on urgent basis
				}
				else
				{
//					 $.validator.addMethod("uniqueMobile", function(value, element) { }, "Mobile is already taken.");
                                          $('#CustomerForm_customer_contact_no_em_').html('Mobile is already taken.').css('display','block');  
				}
                                //Validation ends
		  }
	  }
	  
	  function checkmobile()
	  {
		   var isSuccess = false;
		  jQuery.ajax({ url: "<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/getuniquemobile", 
					  data: "checkmoble="+$("#customer_contact_no").val(), 
					  async: false, 
					  success: 
							function(msg) { isSuccess = msg === "true" ? true : false }
					});
			return isSuccess;
		  
	  }
	  function checkemail()
	  {
//		  var isSuccess = false;
//		  jQuery.ajax({ url: "<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/getuniqueemail", 
//					  data: "checkEmail="+$('#customer_email').val(), 
//					  async: false, 
//					  success: 
//							function(msg) { isSuccess = msg === "true" ? true : false }
//					});
//			return isSuccess;
//		  
	  }
     function afterValidates()
     
     {    var sms = false;
         var smsemail = false; 
         if(jQuery("#sendsms").is(':checked')){
             sms = jQuery('#sendsms').val();
         }  if(jQuery("#sendsmsemal").is(':checked')){
             smsemail = jQuery('#sendsmsemal').val();
         }
         
         
		  jQuery(".errorSummary").css('display','none');
		  jQuery('#customerDialog').dialog('close');
		  //jQuery("#ajaxloader").show();
		  jQuery(".appbook").css("opacity","0.5");
		  var starttime					=	jQuery('#starttime').val();
		  var endtime						=	jQuery('#endtime').val();
		  var seatid						=	jQuery('#seatid').val();
		  var customerid					=	jQuery('#customerid').val();
		  var slctd_services				=	jQuery('#slctd_services').val();
		  var customer_name				=	jQuery('#customer_name').val();
		  var customer_contact_no		=	jQuery('#customer_contact_no').val();
		  var customer_email				=	jQuery('#customer_email').val();
//		  var sms 							= 	jQuery('#sendsms').val();
//		  var smsemail						=	jQuery("#sendsmsemal").val();
		  
		  var url = "<?php echo Yii::app()->request->baseUrl; ?>/users/bookappointment";
		  jQuery.post( url, { starttime: starttime , endtime: endtime, seatid: seatid, customerid: customerid, slctd_services: slctd_services, customer_name: customer_name, customer_contact_no: customer_contact_no, customer_email: customer_email, sms: sms, smsemail: smsemail},
				function( data ) {
					 
					 //jQuery("#ajaxloader").hide();
					 
					 var obj 			= 	jQuery.parseJSON(data);
					 var endtime		=	parseInt(obj.endtime);
					 var starttime		=	parseInt(obj.starttime);
					 var timediff		=	(endtime - starttime)/ 675;
					 var oneslottime	=	parseInt(900);
					 var bookedblocks =	(endtime - starttime)/900;
					 var blockheight	=	bookedblocks * 19;
					 var loopinnertime	=	starttime;
					 
					 var totalminbooked	=	bookedblocks * 15;
					 var totalamount		=	obj.totalamounts;
					 for(looptime = 0; looptime < bookedblocks; looptime++)
					 {
						  if(looptime == 0)
						  {
								var time1 = jQuery("#slot-"+seatid+"-"+loopinnertime).attr('time1');
								var newajaxclass 	 = 'ajax'+loopinnertime;
								jQuery("#slot-"+seatid+"-"+loopinnertime).addClass(newajaxclass);
						  }
						 if(looptime != 0)
						  {
								var customtooltip  = "#slot-"+seatid+"-"+loopinnertime;
								jQuery("#slot-"+seatid+"-"+loopinnertime).css('visibility','hidden');
								
								
								
						  }
						  jQuery("#slot-"+seatid+"-"+loopinnertime).attr("orderid",obj.orderid);
						  jQuery("#slot-"+seatid+"-"+loopinnertime).removeClass('empty_slots');
						  jQuery("#slot-"+seatid+"-"+loopinnertime).addClass('booked_slots');
						  loopinnertime = loopinnertime +  oneslottime;
						  var time2 	 = jQuery("#slot-"+seatid+"-"+loopinnertime).attr('time1');
						  
					 }
					 
					 var tooltip			=	time1+' - '+ time2 +' <br>'+obj.tooltip;
					 var htnmltoblock		=	'<div style=" height:'+blockheight+'px;" class="booked-space"><p title="'+tooltip+'">'+obj.customername+'<br>'+obj.contactno+'</p></div>';
					 jQuery("#slot-"+seatid+"-"+obj.starttime).load().html(htnmltoblock);
					 resetgrid();
					 
					 
					 jQuery("."+newajaxclass+" p[title]").qtip({'position':{'corner':{'target':'rightMiddle','tooltip':'leftTop'}},'show':{'when':{'event':'mouseover'},'effect':{'length':300}},'hide':{'when':{'event':'mouseout'},'effect':{'length':300}},'style':{'color':'black','name':'blue','border':{'width':7,'radius':5}}});
					 //jQuery(customtooltip).qtip({'position':{'corner':{'target':'rightMiddle','tooltip':'leftTop'}},'show':{'when':{'event':'mouseover'},'effect':{'length':300}},'hide':{'when':{'event':'mouseout'},'effect':{'length':300}},'style':{'color':'black','name':'blue','border':{'width':7,'radius':5}}});
					 jQuery(".appbook").css("opacity","1");
					 jQuery('#customerDialog').dialog('close');
					 
				}
		  );

	 
     }
     

    
</script>
