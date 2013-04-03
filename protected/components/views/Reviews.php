<?php /***/
   $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
     'id'=>"reviewform",
     'cssFile'=>'jquery-ui-1.8.7.custom.css',
     'theme'=>'redmond',
     'themeUrl'=>Yii::app()->request->baseUrl.'/css/ui',
     'options'=>array(
         'title'=>'Submit Review',
         'autoOpen'=>false,
         'modal'=>true,
         'width'=>450,
     ),
   ));

?>
<div id="update_infos"></div>
<div id="div_com_forms">
    <div class="form popupforms">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'review-form',
    'enableAjaxValidation'=>true,
				'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false),
    'htmlOptions'=>array(
                'class'=>'review',)
)); ?>

<!--    <p class="note">Fields with <span class="required">*</span> are required.</p>-->

    <?php //echo $form->errorSummary($model); ?>
   
    <div class="row">
        <?php //echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('value'=>'Name','id'=>'name' , 'onblur'=>"if(this.value==''){this.value='Name'}", 'onclick'=>"if(this.value=='Name'){this.value=''}")); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('value'=>'Email','id'=>'email' , 'onblur'=>"if(this.value==''){this.value='Email'}", 'onclick'=>"if(this.value=='Email'){this.value=''}")); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'review'); ?>
        <?php echo $form->textArea($model,'review',array('value'=>'Review','id'=>'review', 'onblur'=>"if(this.value==''){this.value='Review'}", 'onclick'=>"if(this.value=='Review'){this.value=''}")); ?>
        <?php echo $form->error($model,'review'); ?>
    </div>

<!--    <div class="row">
        <?php //echo $form->labelEx($model,'mobile'); ?>
        <?php //echo $form->textField($model,'mobile'); ?>
        <?php// echo $form->error($model,'mobile'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'status'); ?>
        <?php //echo $form->textField($model,'status'); ?>
        <?php //echo $form->error($model,'status'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'website'); ?>
        <?php //echo $form->textField($model,'website'); ?>
        <?php //echo $form->error($model,'website'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'avtar'); ?>
        <?php //echo $form->textField($model,'avtar'); ?>
        <?php //echo $form->error($model,'avtar'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'date'); ?>
        <?php //echo $form->textField($model,'date'); ?>
        <?php //echo $form->error($model,'date'); ?>
    </div>-->   


    <div class="row send">
        <?php echo CHtml::ajaxSubmitButton('Submit',CHtml::normalizeUrl(array('site/reviewsub','id'=>$merchant_id)),array(
                                    'beforeSend'=>'function(){
                                        $("#update_infos").replaceWith("<div id=\"update_infos\"><img src=\"/images/loading.gif\"></div>");
                                    }',
                                    'success'=>'function(data){
                                        if(data=="sent"){
                                        $("#div_com_forms").hide();
                                            $("#update_infos").replaceWith("<div id=\"update_infos\"><h2>Thankyou</h2><br>Your review has been submitted for admin moderation.Check back soon to see your review here...</div>");
                                        }else if(data=="fail"){
                                            $("#div_com_forms").hide();
                                            $("#update_infos").replaceWith("<div id=\"update_infos\">An error occured</div>");
                                        }else{
                                            $("#update_infos").replaceWith("<div id=\"update_infos\">&nbsp;</div>");
                                            if(data.search("Name cannot be blank.")!=-1){
                                                $("#Review_name_em_").replaceWith("<div id=\"Review_name_em_\" class=\"errorMessagerev\" style=\"\">Name cannot be blank.</div>");
                                            }
                                            if(data.search("Email cannot be blank.")!=-1){
                                                $("#Review_email_em_").replaceWith("<div id=\"Review_email_em_\" class=\"errorMessagerev\" style=\"\">Email cannot be blank.</div>");
                                            }
                                            if(data.search("Email is not a valid email address.")!=-1){
                                                $("#Review_email_em_").replaceWith("<div id=\"Review_email_em_\" class=\"errorMessagerev\" style=\"\">Email is not a valid email address.</div>");
                                            }
                                            if(data.search("Review cannot be blank.")!=-1){
                                                $("#Review_review_em_").replaceWith("<div id=\"Review_review_em_\" class=\"errorMessagerev\" style=\"\">Post some review here.</div>");
                                            }
                                            if(data.search("The verification code is incorrect.")!=-1){
                                                $("#ContactForm_verifyCode_em_").replaceWith("<div id=\"ContactForm_verifyCode_em_\" class=\"errorMessagerev\" style=\"\">The verification code is incorrect.</div>");
                                            }
														  if(data.search("Message cannot be blank.")!=-1)
														  {
																$("#ContactForm_body_em_").replaceWith("<div id=\"ContactForm_body_em_\" class=\"errorMessage\" style=\"\">Message can not be blank.</div>");
														  }
                                        }
                                    }',
                                )); ?>
    </div>
<input type="hidden" name="Review[merchant_id]" id="merchant-id" value="<?php echo $merchant_id; ?>" />
    

<?php $this->endWidget(); ?>
    
    </div><!-- form -->
</div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>