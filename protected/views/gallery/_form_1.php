<?php
/* @var $this GalleryController */
/* @var $model Gallery */
/* @var $form CActiveForm */
?>
<div id="merchant-setting-form">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gallery-form',
	'enableAjaxValidation'=>true,
     'htmlOptions' => array(
        	'enctype' => 'multipart/form-data',),
)); ?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>

                <td valign="top">
	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->
        <p class="note">Choose images to upload then click upload.</p>
	<?php echo $form->errorSummary($model); ?>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>-->
       
	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		 <?php
		  $this->widget('CMultiFileUpload', array(
		     'model'=>$model,
		     'name'=>'image',
//		     'attribute'=>'image',
		     'accept'=>'jpg|gif|png',
		     /*'options'=>array(
			'onFileSelect'=>'function(e, v, m){ alert("onFileSelect - "+v) }',
			'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
			'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
			'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
			'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
			'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
		     ),*/
		  ));
		?>
                    <?php //echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>
        <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Upload' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</td>

            </tr>
        </table>
</div><!-- form -->
</div>