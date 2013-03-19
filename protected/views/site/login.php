<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="signup">
	<div class="signup-left">
		<h1>Login</h1>
		<?php if(Yii::app()->user->hasFlash('acc_active')): ?> 
			<div class="flash-success">
				<?php echo Yii::app()->user->getFlash('acc_active'); ?>
			</div>
		<?php endif; ?>
		<?php if(Yii::app()->user->hasFlash('forgotpass')): ?> 
			<div class="flash-success">
				<?php echo Yii::app()->user->getFlash('forgotpass'); ?>
			</div>
		<?php endif; ?>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
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

		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array("class"=>'textbox')); ?>
		<?php echo $form->error($model,'password'); ?>


		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe',array("class"=>'check rememberme')); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
		
		<?php echo CHtml::link('Forgot password?',array('users/forgotpass'),array('class'=>'forgotpass')); ?>
	
		<?php echo CHtml::submitButton('Login',array('class'=>'login-button')); ?>
	
		<?php $this->endWidget(); ?>
	</div><!-- form -->
	
	<div class="clear"></div>
</div>
