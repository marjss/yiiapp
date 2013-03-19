<?php 
   $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
     'id'=>"contacts",
     'cssFile'=>'jquery-ui-1.8.7.custom.css',
     'theme'=>'redmond',
     'themeUrl'=>Yii::app()->request->baseUrl.'/css/ui',
     'options'=>array(
         'title'=>'Request Appointment',
         'autoOpen'=>false,
         'modal'=>true,
         'width'=>450,
     ),
   ));

?>
<div id="update_info"></div>
<div class="content-protal-box contactus-box" id="div_com_form">
    <div class="form popupforms">

    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'contact-form',
            
            'enableAjaxValidation'=>true,
				'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false),

            'htmlOptions'=>array(
                'class'=>'contact',
            ),

    )); ?>
<?php echo $form->errorSummary($model); ?>
       
	<div class="row">
		<?php echo $form->textField($model,'name',array('value'=>'Name','id'=>'contactname' , 'onblur'=>"if(this.value==''){this.value='Name'}", 'onclick'=>"if(this.value=='Name'){this.value=''}")); ?>
                <?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->textField($model,'email',array('value'=>'Email','id'=>'contactemail' , 'onblur'=>"if(this.value==''){this.value='Email'}", 'onclick'=>"if(this.value=='Email'){this.value=''}")); ?>
                <?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->textField($model,'mobileno', array('value'=>'Mobile No','id'=>'mobileno', 'onblur'=>"if(this.value==''){this.value='Mobile No'}", 'onclick'=>"if(this.value=='Mobile No'){this.value=''}")); ?>
                <?php echo $form->error($model,'mobileno'); ?>
	</div>
	 <div class="row">
		<?php echo $form->textField($model,'subject', array('value'=>'Subject','id'=>'subject', 'onblur'=>"if(this.value==''){this.value='Subject'}", 'onclick'=>"if(this.value=='Subject'){this.value=''}")); ?>
                <?php echo $form->error($model,'subject'); ?>
	</div>
        
        
        
        <div class="row">
            
            <?php //  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//                                    'model'=>$model,
//                                    'attribute'=>'date',
//                                     'value' => 'Date',
//                                    'options'=>array(
//                                        'changeYear' => 'true',
//                                        'showAnim' =>'slide',
//                                        'dateFormat'=>'yy-mm-dd',
//                                         
//                                    ),
//                                    'htmlOptions'=>array(
//                                        'value' => 'Date',
////                                        'class'=>'appcalander',
////                                        'style'=>'height:20px;'
////                                            'placeholder'=>'Date'
//                                        'onfocus' => "if(this.value==''){this.value='Date'}",
//                                        'onclick'=>"if(this.value=='Date'){this.value=''}",
//                                    ),
//                                ));?>
            
            
		<?php// echo $form->textField($model,'date', array('value'=>'Date','id'=>'date', 'onblur'=>"if(this.value==''){this.value='Date'}", 'onclick'=>"if(this.value=='Date'){this.value=''}")); ?>
               
	</div>
        
        <div class="row">
            <?php
            $this->widget('application.extensions.timepicker.EJuiDateTimePicker', array(
                            'model'=>$model,
                             'attribute'=>'date',
                                
                             // additional javascript options for the date picker plugin
                             'options'=>array(
                                 'showPeriod'=>true,
                                 'changeYear' => 'true',
                                  'showAnim' =>'drop',
                                 'showPeriod' => 'true',
                                 'stepMinute' => 15,
//                                  'dateFormat'=>'yy-mm-dd',
                                  'hours'=>array('starts'=>9, 'ends'=>17),
                                 'ampm'=>true,
                                 
                                 ),
                             'htmlOptions'=>array(
                                 'value' => 'Date',
                                 'onfocus' => "if(this.value==''){this.value='Date'}",
                                 'onclick'=>"if(this.value=='Date'){this.value=''}", ),
                         ));
?>
             <?php echo $form->error($model,'date'); ?>
            
        </div>
        
        
        
	<div class="row ">
    <?php $model->body = 'Message'?>
		<?php echo $form->textArea($model,'body',array('value'=>'Message','id'=>'msgbox', 'onblur'=>"if(this.value==''){this.value='Message'}", 'onclick'=>"if(this.value=='Message'){this.value=''}")); ?>
                <?php echo $form->error($model,'body'); ?>
	</div>
	 <input type="hidden" name="merchant" id="merchant-id" />
	<?php /*if(CCaptcha::checkRequirements()): ?>
	<div class="row captcha-relative-right">
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode', array('class'=>'captchacpde' , 'value'=>'Captcha Code' ,  'onblur'=>"if(this.value==''){this.value='Captcha Code'}", 'onclick'=>"if(this.value=='Captcha Code'){this.value=''}")); ?>
		</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif;*/ ?>

	<div class="row send">
		<?php echo  CHtml::ajaxSubmitButton(
//                                    'Confirm Appointment',
                                'Request',
                                CHtml::normalizeUrl(array('site/ajaxRequestAppointment')),
                                array(
                                    'beforeSend'=>'function(){
                                        $("#update_info").replaceWith("<p id=\"update_info\">sending...</p>");
                                    }',
                                    'success'=>'function(data){
                                        if(data=="sent"){
                                            $("#div_com_form").hide();
                                            $("#update_info").replaceWith("<p id=\"update_info\"><h3 class=\"spa-name\">Thank you</h3>Request has been sent successfully to </p>");
                                        }else if(data=="fail"){
                                            $("#div_com_form").hide();
                                            $("#update_info").replaceWith("<p id=\"update_info\">An error occured</p>");
                                        }else{
                                            $("#update_info").replaceWith("<p id=\"update_info\">&nbsp;</p>");
                                            if(data.search("Mobile cannot be blank.")!=-1){
                                                $("#ContactForm_mobileno_em_").replaceWith("<div id=\"ContactForm_mobileno_em_\" class=\"errorMessage\" style=\"\">Mobile cannot be blank.</div>");
                                            }
														  if(data.search("Name cannot be blank.")!=-1){
                                                $("#ContactForm_name_em_").replaceWith("<div id=\"ContactForm_name_em_\" class=\"errorMessage\" style=\"\">Name cannot be blank.</div>");
                                            }
                                            if(data.search("Subject cannot be blank.")!=-1){
                                                $("#ContactForm_subject_em_").replaceWith("<div id=\"ContactForm_subject_em_\" class=\"errorMessage\" style=\"\">Subject cannot be blank.</div>");
                                            }
                                            if(data.search("Email cannot be blank.")!=-1){
                                                $("#ContactForm_email_em_").replaceWith("<div id=\"Comment_email_em_\" class=\"errorMessage\" style=\"\">Email cannot be blank.</div>");
                                            }
                                            if(data.search("Email is not a valid email address.")!=-1){
                                                $("#ContactForm_email_em_").replaceWith("<div id=\"Comment_email_em_\" class=\"errorMessage\" style=\"\">Email is not a valid email address.</div>");
                                            }
                                            if(data.search("Date cannot be blank.")!=-1){
                                                $("#ContactForm_date_em_").replaceWith("<div id=\"ContactForm_date_em_\" class=\"errorMessage\" style=\"\">Date cannot be blank.</div>");
                                            }
                                            if(data.search("The verification code is incorrect.")!=-1){
                                                $("#ContactForm_verifyCode_em_").replaceWith("<div id=\"ContactForm_verifyCode_em_\" class=\"errorMessage\" style=\"\">The verification code is incorrect.</div>");
                                            }
														  if(data.search("Message cannot be blank.")!=-1)
														  {
																$("#ContactForm_body_em_").replaceWith("<div id=\"ContactForm_body_em_\" class=\"errorMessage\" style=\"\">Message can not be blank.</div>");
														  }
                                        }
                                    }',
                                )
                            ); ?>

	</div>

    <?php $this->endWidget(); ?>
    
    </div><!-- form -->
</div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>