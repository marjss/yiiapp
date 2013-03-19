<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pages-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'page_title'); ?>
		<?php echo $form->textField($model,'page_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'page_title'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
	<?php
		/*$this->widget('ext.ckeditor.CKEditorWidget',array(
						"model"=>$model,                 # Data-Model
						"attribute"=>'content',          # Attribute in the Data-Model
						"defaultValue"=>$model->content,     # Optional
						"config" => array(
							"height"=>"300px",
							"width"=>"77%",
							//"toolbar"=>"Basic",
							),
						)
					  
					  );
		*/
		echo $form->textArea($model,'content',array('maxlength' => 300, 'rows' => 6, 'cols' => 50)); 
		?>
		<?php echo $form->error($model,'content'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->radioButtonList($model,'is_active',array('0'=>'Inactive','1'=>'Active'),array('separator'=>'','class'=>'pagesactive','labelOptions'=>array('style'=>'display:inline'))); ?>
		<?php echo $form->error($model,'is_active'); ?>
	</div>

	<div class="row buttons">
		<?php //$image = CHtml::image(Yii::app()->baseurl.'/images/close.png'); ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<?php //echo CHtml::link('Close',array('//pages/admin'),array('class'=>'closeimage')); ?>
	</div>
	
<?php
$this->endWidget(); ?>

</div><!-- form -->