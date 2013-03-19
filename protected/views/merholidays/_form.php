<?php
/* @var $this MerholidaysController */
/* @var $model Merholidays */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'merholidays-form',
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
		<?php echo $form->labelEx($model,'date'); ?>
		<?php
		    $this->widget('zii.widgets.jui.CJuiDatePicker',
			array(
				// you must specify name or model/attribute
				'model'=>$model,
				'attribute'=>'date',
				'name'=>'Merholidays[date]',
		
				// optional: what's the initial value/date?
				//'value' => $model->projectDateStart
				'value' => 'now',
		
				// optional: change the language
				//'language' => 'de',
				//'language' => 'fr',
				//'language' => 'es',
				'language' => 'en',
		
				/* optional: change visual
				 * themeUrl: "where the themes for this widget are located?"
				 * theme: theme name. Note that there must be a folder under themeUrl with the theme name
				 * cssFile: specifies the css file name under the theme folder. You may specify a
				 *          single filename or an array of filenames
				 * try http://jqueryui.com/themeroller/
				*/
				'themeUrl' => Yii::app()->baseUrl.'/css/jui' ,
				'theme'=>'..',	//try 'bee' also to see the changes
				'cssFile'=>array('jquery-ui.css' /*,anotherfile.css, etc.css*/),
		
		
				//  optional: jquery Datepicker options
				'options' => array(
					// how to change the input format? see http://docs.jquery.com/UI/Datepicker/formatDate
					'dateFormat'=>'yy-mm-dd',
		
					// user will be able to change month and year
					'changeMonth' => 'true',
					'changeYear' => 'true',
		
					// shows the button panel under the calendar (buttons like "today" and "done")
					'showButtonPanel' => 'false',
		
					// this is useful to allow only valid chars in the input field, according to dateFormat
					'constrainInput' => 'false',
		
					// speed at which the datepicker appears, time in ms or "slow", "normal" or "fast"
					'duration'=>'fast',
		
					// animation effect, see http://docs.jquery.com/UI/Effects
					'showAnim' =>'slide',
				),
		
		
				// optional: html options will affect the input element, not the datepicker widget itself
				'htmlOptions'=>array(
						'style'=>'height:25px;
										background:#ffffff;
										color:#00a;
										font-weight:bold;
										font-size:0.9em;
										border: 1px solid #A80;
										padding-left: 4px; margin-top: 10px;',
						
					
				)
			)
		);

		?>    
		    
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->DropDownList($model,'status',$active); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<?php echo CHtml::Link('Close',array('merholidays/admin')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->