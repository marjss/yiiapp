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
                'id'=>'invoiceDialog',
//                'theme'=>'...',
//                'themeUrl'=>'...',
	       'cssFile'=>Yii::app()->request->baseUrl.'/css/jquery-ui.css',
                'options'=>array(
                    'title'=>'try invoice',
                    'autoOpen'=>false,
		     'closeOnEscape' => true,
                    'modal'=>'true',
                    'width'=>'600',
                    'height'=>'500',
                    'close'=>'js:function(){ 
                        function resetgrid()
            {               jQuery("input.check-service").attr( "checked", false );
            jQuery(".new-td").removeClass("selectable")
            jQuery(".new-td").removeClass("highlighted_slot");
            serviceselected	=	0;
            serviceduration 	= 	0;
            booked				=	0;
            jQuery(".new-td").removeClass("empty_slots");
            jQuery(".new-td").removeClass("selectable");
            jQuery(".new-td").removeClass("selected_slot");
            jQuery("a#service-select").html("-- Select Services --<span></span>");
            jQuery("#m-service ul li").removeClass("setected");
            }                       resetgrid();
                        jQuery(".appbook").css("opacity","1");
                        }',

		    //'buttons'=>array('Cancel'=>'js:function(){$(this).dialog("close")}')
                ),
            ));
    ?>
    <br />
    <div class="dialog_input">
	  <input type="hidden" id = "starttime" name="starttime" value = "0">
	  <input type="hidden" id = "endtime" name="endtime" value = "0">
	  <input type="hidden" id = "seatid" name="seatid" value = "0">
	  <input type="hidden" id = "customerid" name="customerid" value = "0">
	  <input type="hidden" id = "slctd_services" name="slctd_services" value = "0">	
    </div>
       


 <input type="hidden" id = "newclientpopup" name="newclientpopup" value = "0">

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
 <script>
// $(document).on('click', '.done1', function(e){
//     alert(this);
//        jQuery(this).dialog("destroy");
//    });
 </script>