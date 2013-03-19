<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Register',
);
?>

<div class="signup">	
	<div class="signup-left">
		<h1>Start your free trial</h1>
		Quick start your online booking system
		<?php if(Yii::app()->user->hasFlash('mailsent')): ?> 
			<div class="flash-success">
				<?php echo Yii::app()->user->getFlash('mailsent'); ?>
			</div>
		<?php endif; ?>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'signup-form1',
			'action'=>array('/users/signup?plan='.$_REQUEST['plan']),
			 'enableClientValidation'=>true,
			'enableAjaxValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			    ),
			'htmlOptions' => array("class"=>"signup-form"),
		
		)); ?>

		<p class="note">Fields with <span class="required">*</span> are required.</p>
		
			<?php //echo $form->errorSummary($model); ?>
		<br />
      
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'textbox')); ?>
		<?php echo $form->error($model,'name'); ?>
		
		<input type="hidden" id = "pricingplan" name="pricingplan" value = '<?php echo $_GET['plan']; ?>' >
			
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'textbox')); ?>
		<?php echo $form->error($model,'username'); ?>
	
        
      
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'textbox')); ?>
		<?php echo $form->error($model,'email'); ?>
	
    
		<?php echo $form->labelEx($model,'mobile_no'); ?>
		<?php echo $form->textField($model,'mobile_no',array('class'=>'textbox')); ?>
		<?php echo $form->error($model,'mobile_no'); ?>


		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'textbox')); ?>
		<?php echo $form->error($model,'password'); ?>

    
       
		<?php echo $form->labelEx($model,'confirm_password'); ?>
		<?php echo $form->passwordField($model,'confirm_password',array('class'=>'textbox')); ?>
		<?php echo $form->error($model,'confirm_password'); ?>
	
       
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('class'=>'textbox')); ?>
		<?php echo $form->error($model,'city'); ?>
	
           
            <!--<label id='label_renting'  class="checkboxOff"> -->
                <?php echo $form->checkBox($model,'terms', array('class'=>'check', 'checked'=>'','value'=>1, 'uncheckValue'=>NULL));?>
                 <span>By clicking on Signup, you agree to the Salonier <?php echo CHtml::link('Terms',Yii::app()->request->baseUrl.'/terms');?> &amp; <?php echo CHtml::link('Privacy Policy',Yii::app()->request->baseUrl.'/privacy');?></span>
		<?php echo $form->error($model,'terms',array('class'=>'termtext')); ?>
    
	
		<?php echo CHtml::submitButton('Sign up',array('class'=>'Signup-button')); ?>

	</div>
	<?php $this->endWidget();
	$time = time();
	
	?>

	<div class="signup-right">
		<p>You've selected "<?php echo $pricingplan->name;?>" plan. It's FREE for 30 days and renews at Rs. <?php echo $pricingplan->cost;?> per <?php echo $pricingplan->validity_type;?>.</p><br />
		<p>Your 30-days free trial continues until midnight on <?php echo date('F d, Y',strtotime('+30 days'));?>.</p><br />
		<p>You may cancel, upgrade or modify your plan at any time.  </p><br />
		<span>Thank you for choosing <br />SalonChimp! </span>
	</div>
	<div class="clear"></div>

</div>

<script type="text/javascript">
function logincheckboxCheck () {
  if (document.getElementById("UserRegister_terms").checked) {
	 document.getElementById("label_renting").className="checkboxOff";
	 document.getElementById("UserRegister_terms").checked = '';
   }
	else {
	document.getElementById("label_renting").className="checkboxOn";
	document.getElementById("UserRegister_terms").checked = 'checked';
	}
}
</script>