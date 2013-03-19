<?php
$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
	'Manage Account',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));
?>
<h1>Manage Account </h1>
<?php if(Yii::app()->user->hasFlash('success')): ?>

<div class="flash-success">
   	<?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php endif; ?>
<div id="merchant-setting-form">
		<div class="form">
				<?php $form=$this->beginWidget('CActiveForm', array(
						  'id'=>'account-form',
						  'enableAjaxValidation'=>true,
						  'htmlOptions' => array('enctype' => 'multipart/form-data'),
					 )); ?>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
		
								<td valign="top">
										<p class="note">Fields with <span class="required">*</span> are required.</p>
										<div class="row">
											<?php echo $form->labelEx($model,'name'); ?>
											<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
											<?php echo $form->error($model,'name'); ?>
										</div>
										<?php echo $form->hiddenField($model,'id',array('value'=>$uid)); ?>
										<div class="row">
											<?php echo $form->labelEx($model,'avtar'); ?>
											<?php echo $form->fileField($model,'avtar',array('size'=>38)); ?>
											<?php echo $form->error($model,'avtar'); ?>
										</div>
										<div class="row">
											<?php echo $form->labelEx($model,'address'); ?>
											<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
											<?php echo $form->error($model,'address'); ?>
										</div>
										<div class="row">
											<?php echo $form->labelEx($model,'city'); ?>
											<?php echo $form->dropDownList($model, 'city', 	Citylist::model()->getAllCitylistDropDown(), array('prompt'=>'Select City'));  ?>
											<?php echo $form->error($model,'city'); ?>
										</div>
										<div class="buttons">
											<?php echo CHtml::submitButton('Save'); ?>
										</div>
										<?php $this->endWidget(); ?>
				
								</td>
								<td valign="top">
										<div class="account-atvar">
												
												<?php if($model->avtar):?>
														<?php $avtarimage = Yii::app()->request->baseUrl."/".$model->avtar;?>
												<?php else:?>
														<?php $avtarimage = Yii::app()->request->baseUrl."/avtar/no-image.png";?>
												<?php endif;?>
												<?php echo CHtml::image($avtarimage);?>
										</div>
										<?php if($model->avtar):?>
										<div class="remove-avtar">
												<?php echo CHtml::link('Remove',array('users/deleteavtar'),array('confirm' => 'Are you sure?','class'=>'remove-avtar')); ?>
										</div>
										<?php endif;?>
								</td>
						</tr>
				</table>
		</div><!-- form -->
</div>
