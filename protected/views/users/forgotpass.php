<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' -Forgot Password'; ?>

<div class="signup">
	<div class="signup-left">
		<h1>Forgot password</h1>
		<?php if(Yii::app()->user->hasFlash('forgotpass')): ?> 
			<div class="flash-success">
				<?php echo Yii::app()->user->getFlash('forgotpass'); ?>
			</div>
		<?php endif; ?>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'forgotpass-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
			'htmlOptions' => array("class"=>"signup-form"),
		)); ?>

		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array("class"=>'textbox')); ?>
		<?php echo $form->error($model,'email'); ?>

		
		
		<?php //echo CHtml::link('Login',array('site/login'),array('class'=>'forgotpass')); ?>
	
		<?php echo CHtml::submitButton('Submit',array('class'=>'submit-button')); ?>
	
		<?php $this->endWidget(); ?>
	</div><!-- form -->
	
	<div class="clear"></div>
</div>
