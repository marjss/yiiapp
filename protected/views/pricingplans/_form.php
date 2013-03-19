<?php
/* @var $this PricingplansController */
/* @var $model Pricingplans */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pricingplans-form',
	'enableAjaxValidation'=>false,
));

for($i=1;$i<=50;$i++){
	$stylist_count[$i] = $i;
}

?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cost'); ?>
		<?php echo $form->textField($model,'cost'); ?>
		<?php echo $form->error($model,'cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'validity'); ?>
		<?php echo $form->textField($model,'validity'); ?>
		<?php echo $form->error($model,'validity'); ?>
	</div>

	<div class="row validityradio">
		<?php echo $form->labelEx($model,'validity_type'); ?>
		<?php echo $form->radioButtonList($model,'validity_type',array('day'=>'Day','month'=>'Month', 'External'=>'Year')); ?>
		<?php echo $form->error($model,'validity_type'); ?>
	</div>

	<div class="row stylistradio">
		<?php echo $form->labelEx($model,'stylists'); ?>
		<?php echo $form->radioButtonList($model,'stylists',array('0'=>'Unlimited','1'=>'Limited'),array('id'=>'stylistbutton')); ?>
		<div id="stylistcount" style="display:none;"><?php echo $form->DropDownList($model,'stylists',$stylist_count); ?></div>
		<?php echo $form->error($model,'stylists'); ?>
	</div>

	<!--<div class="row">
		<?php //echo $form->labelEx($model,'status'); ?>
		<?php //echo $form->textField($model,'status',array('size'=>1,'maxlength'=>1)); ?>
		<?php //echo $form->error($model,'status'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#Pricingplans_stylists_1').click(function() {
		if ($(this).val() === '1') {
			$("#stylistcount").toggle();
		} 
	      });

    });
</script>