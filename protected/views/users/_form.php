<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>
<style>
    #content {
    border: 1px solid #638FB3;
    height: auto;
    padding: 10px;
}
</style>
<div class="form">
<?php // print_r($usermodel);die;?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
));
$active = array(1=>'Active',0=>'In Active');
$featured = array(1=>'Yes',0=>'No');
$roles = Masroles::model()->findAll();
foreach($roles as $val){
	$masroles[$val->id] = $val->name;
}
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		
		<?php echo $form->labelEx($model,'mas_role_id'); ?>
		<?php echo $form->DropDownList($model,'mas_role_id',$masroles); ?>
		<?php echo $form->error($model,'mas_role_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255,)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($usermodel,'name'); ?>
		<?php echo $form->textField($usermodel,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($usermodel,'name'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($usermodel,'mobile_no'); ?>
		<?php echo $form->textField($usermodel,'mobile_no',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($usermodel,'mobile_no'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($usermodel,'address'); ?>
		<?php echo $form->textArea($usermodel,'address',array('size'=>60,'maxlength'=>255,'cols'=>50)); ?>
		<?php echo $form->error($usermodel,'address'); ?>
	</div>
        
        <div class="row">
            <?php echo $form->labelEx($usermodel,'city'); ?>
            <?php echo $form->dropDownList($usermodel, 'city',Citylist::model()->getCityuserDropDown(), array('empty'=>'Select City'));  ?>
            <?php echo $form->error($usermodel,'city'); ?>
	</div>
            <div class="row">
         
         <?php  
         $planmodel= Pricingplansusers::model()->findByAttributes(array('user_id'=>$model->id));
         if($planmodel){
              echo $form->labelEx($planmodel,'pricing_plan_id');
             $list = CMap::mergeArray(array(''=>'- Select -'), CHtml::listData(Pricingplans::model()->findAll(array('order' => 'name')), 'id', 'name'));
         echo CHTML::dropDownList('Pricingplansusers[pricing_plan_id]',$planmodel->pricing_plan_id, $list,array('id'=>'Pricingplansusers_pricing_plan_id',)); 
       echo $form->error($planmodel,'pricing_plan_id'); 
              }
              else {
                 $planmodel =new Pricingplansusers;
          echo $form->labelEx($planmodel,'pricing_plan_id'); 
          $list = CMap::mergeArray(array(''=>'- Select -'), CHtml::listData(Pricingplans::model()->findAll(array('order' => 'name')), 'id', 'name'));
                    echo $form->dropDownList($planmodel,'pricing_plan_id',$list);  
         }
         ?>
      <?php echo $form->error($planmodel,'pricing_plan_id'); ?>

    </div>
        <div class="row">
            <?php echo $form->labelEx($usermodel,'avtar'); ?>
            <?php echo $form->fileField($usermodel,'avtar',array('size'=>38)); ?>
            <?php echo $form->error($usermodel,'avtar'); ?>
	</div>
         <div class="row">
         <?php if($usermodel->avtar):?>
                <?php $avtarimage = Yii::app()->request->baseUrl."/".$usermodel->avtar;?>
             <div class="actionresponse">
                <?php echo CHtml::ajaxButton( "Delete",
                                            array('users/DeleteImage','id'=>$model->id),
                                            array('success'=>'function(data){ jQuery(".actionresponse").html(data) }'),
                                            array('style'=>'display:block')
                                    );              
                ?>
                <?php else:?>
                <?php $avtarimage = Yii::app()->request->baseUrl."/avtar/no-image.png";?>
                 
            <?php endif;?>
             <?php echo CHtml::image($avtarimage);?>
             
         </div>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'featured'); ?>
		<?php echo  $form->DropDownList($model,'featured',$featured); ?>
		<?php echo $form->error($model,'featured'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'onlinebooking'); ?>
		<?php echo  $form->DropDownList($model,'onlinebooking',$featured); ?>
		<?php echo $form->error($model,'onlinebooking'); ?>
	</div>
             <div class="row">
             <?php $active = array(1=>'Active',0=>'Inactive');?>
            <?php echo $form->label($model,'status'); ?>
            <?php $listdata=  CMap::mergeArray(array(''=>'- Select -'),$active); ?>
            <?php echo $form->dropDownList($model,'status',$listdata); ?>
            <?php //echo $form->textField($model,'status',array('size'=>1,'maxlength'=>1)); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
