<?php
/* @var $this MertimingsController */
/* @var $model Mertimings */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mertimings-form',
	'enableAjaxValidation'=>false,
));
$days = array('mon'=>'Monday','tue'=>'Tuesday','wed'=>'Wednesday','thu'=>'Thrusday','fri'=>'Friday','sat'=>'Saturday','sun'=>'Sunday');
$active = array(1=>'Active',0=>'Inactive');

?>




	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->HiddenField($model,'merchant_id'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'day'); ?>
		<?php echo $form->DropDownList($model,'day',$days); ?>
		<?php echo $form->error($model,'day'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'opening_at'); ?>
		
		<?php
			$this->widget('ext.timepicker.EJuiDateTimePicker', array(
					'model' => $model,
					'name' => "opening_at",
					//'tabularLevel' => "[$id]",
					'timePickerOnly'=> TRUE,
					'options'=>array('ampm'=>TRUE,
							//'minuteGrid'=>15,
							'stepHour'=>1,
							'stepMinute' => 15,
							)
				  ));
		
		//echo $form->textField($model,'opening_at'); ?>
		<?php echo $form->error($model,'opening_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'closing_at'); ?>
		<?php
			$this->widget('ext.timepicker.EJuiDateTimePicker', array(
					'model' => $model,
					'name' => "closing_at",
					//'tabularLevel' => "[$model->id]",
					'timePickerOnly'=> TRUE,
					'options'=>array('ampm'=>TRUE,
							//'minuteGrid'=>15,
							'stepHour'=>1,
							'stepMinute' => 15,
							)
				  ));
		
		//echo $form->textField($model,'closing_at'); ?>
		<?php echo $form->error($model,'closing_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->DropDownList($model,'status',$active); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->