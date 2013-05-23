<?php
/* @var $this MerservicesController */
/* @var $model Merservices */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'merservices-form',
	'enableAjaxValidation'=>false,
));
$active = array(1=>'Active',0=>'Inactive');
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

		<?php echo $form->HiddenField($model,'merchant_id'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'cat_id');?>
		<?php echo $form->dropDownList($model,'cat_id', CHtml::listData(CategoryService::model()->findAll(), 'id', 'title'), array('empty'=>'Select Category'),array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model, 'cat_id');?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>(In Rs.)
		<?php echo $form->error($model,'price'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'isproduct'); ?>
		<?php echo $form->checkBox($model,'isproduct',array('class'=>'isproduct')); ?>
		<?php echo $form->error($model,'isproduct'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'stock'); ?>
		<?php echo $form->textField($model,'stock',array('class'=>'stock')); ?>
		<?php echo $form->error($model,'stock'); ?>
	</div>
        
        <div class="dynamics">
        <div class="row">
		<?php echo $form->labelEx($model,'duration'); ?>
		<?php echo $form->textField($model,'duration'); ?>(In multiples of 15 mins )
		<?php echo $form->error($model,'duration'); ?>
	</div>
        </div>
        <div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->DropDownList($model,'status',$active); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<?php echo CHtml::Link('Close',array('merservices/admin')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
   $(document).ready(function() {
       
   if($('#Merservices_isproduct').attr("checked") == "checked"){
       $('.dynamics').css('display','none');
   }
  $("#merchant-setting-form input[type=checkbox]").click(function(){
    if ($(this).attr("checked") == "checked"){
      $('.dynamics').css('display','none');
    } else {
      $('.dynamics').css('display','block');
    }
  });
});


</script>