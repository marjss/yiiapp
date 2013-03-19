<?php
$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
	'Change Paswsword',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));
?>
<h1>Change Password </h1>
<?php if(Yii::app()->user->hasFlash('success')): ?>

<div class="flash-success">
   	<?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php endif; ?>
<div id="merchant-setting-form">
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'cpwd-form',
      	'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	    ),
        )); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div class="row">
		<?php echo $form->labelEx($modelpass,'old password'); ?>
		<?php echo $form->passwordField($modelpass,'oldpassword',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($modelpass,'oldpassword'); ?>
	</div>
	<?php echo $form->hiddenField($modelpass,'id',array('value'=>$uid)); ?>
	<div class="row">
		<?php echo $form->labelEx($modelpass,'new password'); ?>
		<?php echo $form->passwordField($modelpass,'newpassword',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($modelpass,'newpassword'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($modelpass,'retype password'); ?>
		<?php echo $form->passwordField($modelpass,'retypepassword',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($modelpass,'retypepassword'); ?>
	</div>
	<div class="buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>
	<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
        
