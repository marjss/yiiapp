<?php
/* @var $this CategoryServiceController */
/* @var $model CategoryService */
/* @var $form CActiveForm */
?>

<div class="form">
<?php $active = array(1=>'Active',0=>'Inactive');?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-service-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<!-- <div class="row">
		<?php /*echo $form->labelEx($model,'added_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(

			'model'=>$model,
			'attribute'=>'added_date',
			// additional javascript options for the date picker plugin
			'options' => array(
			'showAnim' => 'fold',
			'dateFormat'=>'dd-mm-yy',
			),
			'htmlOptions' => array(
			'style' => 'height:20px;'
			),
			));
		?>
		<?php echo $form->error($model,'added_date'); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(

			'model'=>$model,
			'attribute'=>'modified_date',
			// additional javascript options for the date picker plugin
			'options' => array(
			'showAnim' => 'fold',
			'dateFormat'=>'dd-mm-yy',
			),
			'htmlOptions' => array(
			'style' => 'height:20px;'
			),
			));*/
		?>
		
		<?php echo $form->error($model,'modified_date'); ?>
	</div> -->

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