<?php
/* @var $this MerseatsController */
/* @var $model Merseats */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'merseats-form',
	'enableAjaxValidation'=>true,
));

$stylists = array();
$active = array(1=>'Active',0=>'Inactive');

$merchant_id = Yii::app()->user->id;
$criteria3 = new CDbCriteria();
$criteria3->condition = "merchant_id = '".$merchant_id."' AND status = 1";
$services = Merservices::model()->findAll($criteria3);

?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->HiddenField($model,'merchant_id'); ?>

	<!-- <div class="row">
		<?php /*echo $form->labelEx($model,'stylist_id'); ?>
		<?php echo $form->DropDownList($model,'stylist_id',$stylists); ?>
		<?php echo $form->error($model,'stylist_id');*/ ?>
	</div> -->

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->DropDownList($model,'status',$active); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<?php echo CHtml::Link('Close',array('merseats/admin')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->