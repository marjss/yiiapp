<?php
$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
	'Manage Timing',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));?>

<h1 class="timing-title">Manage Merchant Timings</h1>
<br />
<div class="appbook">
    <?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'managetimings',
        'action'=>'managetimings',
	'enableAjaxValidation'=>true,
        ));
    ?>
        <?php if(Yii::app()->user->hasFlash('savetimings')): ?>    
	    <div class="flash-success">
		    <?php echo Yii::app()->user->getFlash('savetimings'); ?>
	    </div>
        <?php endif; ?>
    <div class="flash-success" style="display:none;" id="notvalue">Please enter the valid opening or closing time.</div>
    <div class="flash-success" style="display:none;" id="wrongvalue">Closing time should be greater than opening time.</div>
    <table width="100%"  cellspacing="1" cellpadding="1" >
       <thead style="text-align:center;">
        <th>Working</th>
        <th>Days</th>
        <th>Opening at</th>
        <th>Closing at</th>
       
      </thead>
       
       <?php
            $days = array('mon'=>'Monday','tue'=>'Tuesday','wed'=>'Wednesday','thu'=>'Thrusday','fri'=>'Friday','sat'=>'Saturday','sun'=>'Sunday');
            foreach($days as $key=>$day) {
                $mertiming = Mertimings::model()->findByAttributes(array('merchant_id'=>Yii::app()->user->id,'day'=>$key));
                if(!$mertiming){
                    $mertiming = new Mertimings;
                }
       ?>
       
       <tr>
             <td>
                 <?php 
                            echo CHtml::activeCheckBox($mertiming,'off', array('class'=>'check','value'=>0,'name'=>'work_'.$key,'id'=> 'work_'.$key,'uncheckValue'=>1,'onclick'=>'return inputdisable("'.$key.'")'));
                        
                    
                    ?>
            </td>
            <td  align="right" valign="top" style=" font-size:15px; width:100px;text-align:center;">
                <?php echo $day; ?>
            </td>
            
            <td class="first-tab">
                <?php
                    $this->widget('ext.timepicker.EJuiDateTimePicker', array(
                                    'model' => $mertiming,
                                    'name' => "opening_at_".$key,
                                    'attribute'=>'opening_at',
                                    //'value'=>'15:00',
                                    //'tabularLevel' => "[$id]",
                                    'timePickerOnly'=> TRUE,
                                    'options'=>array('ampm'=>false,
                                                    //'minuteGrid'=>15,
                                                    'timeFormat'=> 'hh:mm:ss tt',
                                                    'stepHour'=>1,
                                                    'stepMinute' => 15,
                                                    )
                              ));
                    ?>
            </td>
            <td class="second-tab">
                 <?php
                    $this->widget('ext.timepicker.EJuiDateTimePicker', array(
                                    'model' => $mertiming,
                                    'name' => "closing_at_".$key,
                                    'attribute'=>'closing_at',
                                    //'tabularLevel' => "[$id]",
                                    'timePickerOnly'=> TRUE,
                                    'options'=>array('ampm'=>false,
                                                     'timeFormat'=> 'hh:mm:ss tt',
                                                    //'minuteGrid'=>15,
                                                    'stepHour'=>1,
                                                    'stepMinute' => 15,
                                                   // 'hour'=>js:,
                                                    )
                              ));
                    ?>
            </td>
           
            
       </tr>
       <?php } ?>
    </table>
</div>

<?php echo CHtml::submitButton('Save', array('name'=>'save','id'=>'savetimings')); ?>
   <?php $this->endWidget(); ?>


<script type="text/javascript">
   function inputdisable(key){
     var value =$('#work_'+key).attr('checked');
    $('#opening_at_'+key).attr("disabled", !value);
     $('#closing_at_'+key).attr("disabled", !value);
                                  

   }
  
   $(document).ready(function(){
       $('#managetimings input[type="checkbox"]').each(function(){
            if(!($(this).attr('checked')=='checked')){
                $(this).parent().parent('tr').find('input[type="text"]').attr('disabled','disabled');
                
            }  
        });
       
       
       $('#savetimings').click(function(){
            var flag1 = 0;
            var flag2 = 0;
            $('#managetimings input[type="checkbox"]').each(function(){
                if(($(this).attr('checked')=='checked')){
                        var tflag1 = 0;
                        var tflag2 = 0;
                    var tobj1 =$(this).parent('').parent('tr').find('input[type=text]').eq(0);
                    var tobj2 = $(this).parent('').parent('tr').find('input[type=text]').eq(1);
                    var timeval1 = tobj1.val();
                    var timeval2 = tobj2.val();
                    
                    if(timeval1 == '' || timeval2 == '' || timeval1 == '00:00:00' || timeval2 == '00:00:00'){
                        flag1 = 1;
                        tflag1 = 1;
                    }
                    var hr1 = timeval1.split(':');
                     var hr2 = timeval2.split(':');
                    // alert(hr2[0]+' '+hr1[0]);
                    if(hr2[0] < hr1[0] && hr2[1] <= hr1[1]){
                       flag2 = 1;
                       tflag2 = 1;
                    }
                  if(tflag1 == 1 || tflag2 == 1){
                    tobj1.css('border','1px solid red');
                    tobj2.css('border','1px solid red');
                  }
                  
                  
                }
             });
            
            if(flag1 == 1){
                $('#notvalue').show();
                return false;
            }
            if(flag2 == 1){
               
                $('#wrongvalue').show();
                  return false;
            }
        
        });
       
       
    });
     
</script>