<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
   <table cellpadding="0" cellspacing="0" class="searchtable">
		  <tr>
					 <td valign="middle" class="label"><?php echo $form->label($model,'id'); ?></td>
					 <td valign="middle" ><?php echo $form->textField($model,'id'); ?></td>
					 <td valign="middle" class="label"><?php echo $form->label($model,'page_title'); ?></td>
					 <td valign="middle" ><?php echo $form->textField($model,'page_title'); ?></td>
		  </tr>
		  <tr>
					 <td valign="middle" class="label"><?php echo $form->label($model,'slug'); ?></td>
					 <td valign="middle" ><?php echo $form->textField($model,'slug'); ?></td>
					 <td valign="middle" class="label"><?php echo $form->label($model,'content'); ?></td>
					 <td valign="middle" ><?php echo $form->textArea($model,'content'); ?></td>
		  </tr>
		  <tr>
					 <td valign="middle" class="label"><?php echo $form->label($model,'meta_description'); ?></td>
					 <td valign="middle" ><?php echo $form->textArea($model,'meta_description'); ?></td>
					 <td valign="middle" class="label"><?php echo $form->label($model,'meta_keywords'); ?></td>
					 <td valign="middle" ><?php echo $form->textArea($model,'meta_keywords'); ?></td>
		  </tr>
		  <tr>
					 <td valign="middle" class="label"><?php echo $form->label($model,'is_active'); ?></td>
					 <td valign="middle" ><?php echo $form->textField($model,'is_active',array('size'=>1,'maxlength'=>1)); ?></td>
					 <td valign="middle" class="label"><?php echo $form->label($model,'meta_keywords'); ?></td>
					 <td valign="middle" ><?php echo $form->textArea($model,'meta_description'); ?></td>
		  </tr>
		  <tr>
					 <td valign="middle" class="label"> </td>
					 <td valign="middle" ><?php echo CHtml::submitButton('Search'); ?></td>
					 <td valign="middle" class="label"> </td>
					 <td valign="middle" > </td>
		  </tr>
  </table>
	
<?php $this->endWidget(); ?>

</div><!-- search-form -->