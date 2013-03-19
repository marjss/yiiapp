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
										  alert("hello");
										  }',

			      /*'open' =>'js:function(){
									 $("#loading").hide();
									 }',*/
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
	       <div id = "newcustomer" style="display:none;">
		    <?php echo $form1->labelEx($customerform,'customer_name'); ?>
		    <?php echo $form1->textField($customerform,'customer_name', array('size'=>40,'maxlength'=>150,'id'=>'customer_name','class'=>'customer_field required',)) ?>
		     <?php echo $form1->error($customerform,'customer_name'); ?>
		    <br /><br />
		    <?php echo $form1->labelEx($customerform,'customer_contact_no'); ?>
		    <?php echo $form1->textField($customerform,'customer_contact_no', array('size'=>40,'maxlength'=>150,'id'=>'customer_contact_no','class'=>'customer_field required uniqueMobile')) ?>
		    <?php echo $form1->error($customerform,'customer_contact_no'); ?>
		    <br /><br />
		    <?php echo $form1->labelEx($customerform,'customer_email'); ?>
		    <?php echo $form1->textField($customerform,'customer_email', array('size'=>40,'maxlength'=>150,'id'=>'customer_email','class'=>'customer_field required email uniqueEmail')) ?>
		     <?php echo $form1->error($customerform,'customer_email'); ?>
		     <br />
	       </div>
	  <?php //echo $form1->textField($form,'customer_name', array('size'=>40,'maxlength'=>150,'id'=>'customer_id','class'=>'customer_field')) ?>
	
<div id="tobooked_slot">Booking time: <span id="start_time"></span> to <span id="end_time"></span></div>
    <div class="double-process" id="custservices"></div>
    <div class="check">
    	<span>Intimate Customer via: </span>
	 <?php //echo CHtml::checkBox('sms','sms', array('class'=>'checkbox require-one', 'checked'=>'checked','value'=>1, 'uncheckValue'=>NULL));?>
	 <input type="checkbox" value="sms" class="checkbox required" checked='checked' name="sms_email[]" />
        <label>SMS</label>
        
         <?php //echo CHtml::checkBox('email','email', array('class'=>'checkbox require-one', 'checked'=>'checked','value'=>1, 'uncheckValue'=>NULL));?>
	 <input type="checkbox" value="email" class="checkbox required" checked='checked' name="sms_email[]" />
        <label>Email</label>
        <div class="cl"></div>
        
    </div>
	  <input type="button" value="Cancel" class="lookup-button" onclick = "return cancelpopup()"/>
	  <!--<input type="button" value="Time Off" class="lookup-button" /> -->
	  <input type="button" value="+New Client" class="lookup-button" onclick="return getnewclientui()" id="newclientbutton" />
	  <input type="submit" value="Book" class="lookup-button" id="bookbutton" style="display:none;" onclick="return send()"/>
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
     /*function send()
     {
		  
	    var response;
	    $("#booking-form").validate();
		  $.validator.addMethod("uniqueEmail", function(value, element) {
				jQuery.ajax({
					  url: '<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/getuniqueemail',   
					  data: "checkEmail="+value,
					  dataType:"html",
					  success: function(msg)
					  {
						  //If username exists, set response to true
						  response = ( msg == 'true' ) ? true : false;
					  }
					})
				 return response;
		  }, "Email is already taken.");
		  $.validator.addMethod("uniqueMobile", function(value, element) {
				jQuery.ajax({
					 url: '<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/getuniquemobile',   
					 data: "checkmoble="+value,
					 dataType:"html",
					 success: function(msg)
					 {
						 //If username exists, set response to true
						 
						 response = ( msg == 'true' ) ? false : false;
						 
					 }
				})
				return response;
		  }, "Mobile number is already taken.");
	    
	  if(!$("#booking-form").valid()){
	       return false;
	  }
	  else{
	       var url = "<?php echo Yii::app()->request->baseUrl; ?>/users/appointment";
	       $("#ajaxloader").show();
	       $(".appbook").css("opacity","0.5");
		$('#booking-form').ajaxSubmit(
		 {
		    type: "POST",
		    url: url,
		    data: $("#booking-form").serialize(), // serializes the form's elements.
		    success:function(data){
			 $('#customerDialog').dialog('close');
			 $('#successdialog').dialog('open');
			 
			 $("#ajaxloader").hide();
			 $(".appbook").css("opacity","1");
		    }
		 });
	  }
     }*/
     function send()
	  {
		  if($("#booking-form").validate())
		  {
				
				if(checkmobile())
				{
					 if(checkemail())
					 {
						  var url = "<?php echo Yii::app()->request->baseUrl; ?>/users/appointment";
								$("#ajaxloader").show();
								$(".appbook").css("opacity","0.5");
						  $('#booking-form').ajaxSubmit(
							{
								type: "POST",
								url: url,
								data: $("#booking-form").serialize(), // serializes the form's elements.
								success:function(data){
								$('#customerDialog').dialog('close');
								$('#successdialog').dialog('open');
								
								$("#ajaxloader").hide();
								$(".appbook").css("opacity","1");
								}
							});
					 }
					 else
					 {
						  $.validator.addMethod("uniqueEmail", function(value, element) { }, "Email is already taken.");
					 }
				}
				else
				{
					 $.validator.addMethod("uniqueMobile", function(value, element) { }, "Mobile is already taken.");
				}
		  }
	  }
	  
	  function checkmobile()
	  {
		   var isSuccess = false;
		  jQuery.ajax({ url: "<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/getuniqueemail", 
					  data: "checkmoble="+$("#customer_contact_no").val(), 
					  async: false, 
					  success: 
							function(msg) { isSuccess = msg === "true" ? true : false }
					});
			return isSuccess;
		  
	  }
	  function checkemail()
	  {
		  var isSuccess = false;
		  jQuery.ajax({ url: "<?php echo Yii::app()->request->baseUrl; ?>/appointmentbook/getuniqueemail", 
					  data: "checkEmail="+$('#customer_email').val(), 
					  async: false, 
					  success: 
							function(msg) { isSuccess = msg === "true" ? true : false }
					});
			return isSuccess;
		  
	  }
     function afterValidates()
     {
	  var url = "<?php echo Yii::app()->request->baseUrl; ?>/users/appointment";
	
	  $(".errorSummary").css('display','none');
	   $('#customerDialog').dialog('close');
	  $("#ajaxloader").show();
	  $(".appbook").css("opacity","0.5");
	  $('#booking-form').ajaxSubmit(
	  {
	     type: "POST",
	     url: url,
	     data: $("#booking-form").serialize(), // serializes the form's elements.
	     success:function(data){
		   
		  
		    $("#ajaxloader").hide();
		    $(".appbook").css("opacity","1");
		    $('#successdialog').dialog('open');
	     }
	  });
	 
     }
     

    
</script>