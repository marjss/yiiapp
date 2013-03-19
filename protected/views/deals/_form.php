<?php
/* @var $this DealsController */
/* @var $model Deals */
/* @var $form CActiveForm */
?>
<div id="merchant-setting-form">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'deals-form',
	'enableAjaxValidation'=>false,
)); ?>

	<table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>

                <td valign="top">
                    <p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
                    <?php echo $form->hiddenField($model,'merchant_id',array('value'=>$merchant->merchant_id)); ?>
	<div class="row">
		<?php // echo $form->labelEx($model,'merchant_id'); ?>
		<?php //echo $form->textField($model,'merchant_id'); ?>
		<?php //echo $form->error($model,'merchant_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('size'=>60,'cols'=>20,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'offer_price'); ?>
		<?php echo $form->textField($model,'offer_price'); ?>
		<?php echo $form->error($model,'offer_price'); ?>
	</div>

	<div class="row">
                <?php echo $form->labelEx($model,'valid'); ?>
		<?php //echo $form->textField($model,'valid'); ?>
            <?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model'=>$model,
                                    'attribute'=>'valid',
                                     'value' => 'now',
                                    'options'=>array(
                                        'changeYear' => 'true',
                                        'showAnim' =>'slide',
                                        'dateFormat'=>'yy-mm-dd',
                                    ),
                                    'htmlOptions'=>array(
//                                        'class'=>'appcalander',
//                                        'style'=>'height:20px;'
                                    ),
                                ));?>
		<?php echo $form->error($model,'valid'); ?>
	</div>
                    <div class="row">
		<?php echo $form->labelEx($model,'terms'); ?>
		<?php echo $form->textArea($model,'terms',array('size'=>60,'cols'=>20,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'terms'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php// echo $form->textField($model,'status'); ?>
                <?php echo CHtml::activeCheckBox($model,"status"); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
<?php $this->endWidget(); ?>

                </td>

            </tr>
        </table>
</div><!-- form -->
</div>