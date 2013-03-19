<style>
    label.error{ color: red;
     float: left;
     width: 398px !important;
      margin-top: -10px;
    }
</style>
 
  <?php
       $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'updateDialog',
	       'cssFile'=>Yii::app()->request->baseUrl.'/css/jquery-ui.css',
                'options'=>array(
                    'title'=>'Update Order',
                    'autoOpen'=>false,
		     'closeOnEscape' => true,
                    'modal'=>'true',
                    'width'=>'484',
                    'height'=>'auto',
		    //'buttons'=>array('Cancel'=>'js:function(){$(this).dialog("close")}')
                ),
            ));
       
       $form1=$this->beginWidget('CActiveForm', array(
		'id'=>'updatebook-form',
                //'action'=>Yii::app()->request->baseUrl.'/evaluation/MyEvaluation/'.$_REQUEST['id'],
		'enableAjaxValidation'=>false,
                'htmlOptions'=>array(
		    'onsubmit'=>"return false;",/* Disable normal form submit */ 
	       ),
	       
	    ));
       
    ?>
   
   
    <br />
    <div class="dialog_input">
	  <input type="hidden" id = "updatestime" name="updatestime" value = "0">
	  <input type="hidden" id = "updateendtime" name="updateendtime" value = "0">
	  <input type="hidden" id = "seat_id" name="seat_id" value = "0">
	  <input type="hidden" id = "upcustomer_id" name="upcustomer_id" value = "0">
	  <input type="hidden" id = "update_services" name="update_services" value = "0">
             <input type="hidden" id = "lastupdate_order" name="lastupdate_order" value = "0">
            <div id="customerinfotext" class="tobooked_slot"></div>
<div id="update_slot">Booking time:<span id="upstart_time"></span> to <span id="upend_time"></span></div>
    <div class="double-process" id="upcustservices"></div>
    <div class="check">
    	<span>Intimate Customer via:</span>
	 <?php //echo CHtml::checkBox('sms','sms', array('class'=>'checkbox require-one', 'checked'=>'checked','value'=>1, 'uncheckValue'=>NULL));?>
	 <input type="checkbox" value="sms" class="checkbox required" checked='checked' name="sms_email[]" />
        <label>SMS</label>
        
         <?php //echo CHtml::checkBox('email','email', array('class'=>'checkbox require-one', 'checked'=>'checked','value'=>1, 'uncheckValue'=>NULL));?>
	 <input type="checkbox" value="email" class="checkbox required" checked='checked' name="sms_email[]" />
        <label>Email</label>
        <div class="cl"></div>
        
    </div>
	  <input type="submit" value="Book" class="lookup-button" id="bookbutton" onclick="return afterValidatesupdate()"/>
   </div>      
       
       
<?php $this->endWidget(); ?>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<script type="text/javascript">
    function afterValidatesupdate()
     {
	  var url = "<?php echo Yii::app()->request->baseUrl; ?>/users/appointment";
	
	  $(".errorSummary").css('display','none');
	   $('#updateDialog').dialog('close');
	  $("#ajaxloader").show();
	  $(".appbook").css("opacity","0.5");
	  $('#updatebook-form').ajaxSubmit(
	  {
	     type: "POST",
	     url: url,
	     data: $("#updatebook-form").serialize(), // serializes the form's elements.
	     success:function(data){
		    $("#ajaxloader").hide();
		    $(".appbook").css("opacity","1");
		    $('#successdialog').dialog('open');
	     }
	  });
	 
     }
</script>