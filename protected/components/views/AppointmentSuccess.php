 <div class="appoint_success">
 <?php 
       $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'successdialog',
		
	       'cssFile'=>Yii::app()->request->baseUrl.'/css/jquery-ui.css',
                'options'=>array(
                    'title'=>'Customer Order',
                    'autoOpen'=>false,
		     'closeOnEscape' => true,
                    'modal'=>'true',
                    'width'=>'350',
                    'height'=>'auto',
		    //'buttons'=>array('Ok'=>'js:function(){$(this).dialog("close")}')
                ),
            ));
       ?>
      <div class="appsuccess">Appointment booked successfully
	    <input type="button" value="Ok" class="lookup-button" onclick = "return dialogclose()"/>
  </div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
 </div>

<script type="text/javascript">
      function dialogclose(){
	    $('#successdialog').dialog('close');
	 
	    var date = $("#selectdate").attr('value');
	    
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
			$("#service").multiselect('uncheckAll');
			gethighlightedslots();
			
			resethover();
			
		       $("#appointmenttable").html(obj.find('#appointmenttable').html());
		       $(".new-td p[title]").qtip({'position':{'corner':{'target':'rightMiddle','tooltip':'leftTop'}},'show':{'when':{'event':'mouseover'},'effect':{'length':300}},'hide':{'when':{'event':'mouseout'},'effect':{'length':300}},'style':{'color':'black','name':'blue','border':{'width':7,'radius':5}}});
		       $('.updateloader').css('display','none');
		       $("#ajaxloader").hide();
		       $(".appbook").css("opacity","1");
		   }
	   });
      }
</script>