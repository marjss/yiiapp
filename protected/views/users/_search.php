<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="wide form">
<?php $active = array(1=>'Active',0=>'Inactive');?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<!--	<div class="row">
		<?php //echo $form->label($model,'id'); ?>
		<?php //echo $form->textField($model,'id'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->label($model,'mas_role_id'); ?>
            <?php $listdata= CMap::mergeArray(array(''=>'- Select -'), CHtml::listData(Masroles::model()->findAll(),'id','name')); ?>
		<?php echo CHTML::dropDownList('Users[mas_role_id]',$model->masrole->id,$listdata); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
            <?php echo $form->label($model,'status'); ?>
            <?php $listdata=  CMap::mergeArray(array(''=>'- Select -'),$active); ?>
            <?php echo $form->dropDownList($model,'status',$listdata); ?>
            <?php //echo $form->textField($model,'status',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->