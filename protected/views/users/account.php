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

<?php if(Yii::app()->user->hasFlash('success')){ ?>
        
<div class="flash-success">
   	<?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php }elseif(Yii::app()->user->hasFlash('error')){ ?>
        
<div class="flash-success">
   	<?php echo Yii::app()->user->getFlash('error'); ?>
</div>
<?php } ?>
<div id="merchant-setting-form">
    <?php
/*    Yii::app()->clientScript->registerScript('changeDialog', "
    $(function(){
        $('#change-pass').click(function(){
        $('#cpwd-form').load('".Yii::app()->createUrl('users/changepassword')."', function(){
            $('#cpwd-form').dialog('open');
        });
        return false;
        });
    });");
    echo CHtml::link('Change Password', 'changepassword', array('id' => 'change-pass'));
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'cpwd-form',
                'options'=>array(
                    'title'=>Yii::t('password','Change Password'),
                    'autoOpen'=>false,
                    'model'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
    $this->endWidget('zii.widgets.jui.CJuiDialog'); */ ?>
    <div class="form">
				<?php $form=$this->beginWidget('CActiveForm', array(
						  'id'=>'account-form',
						  'enableAjaxValidation'=>false,
                                                  'enableClientValidation'=>true,
						  'htmlOptions' => array('enctype' => 'multipart/form-data'),
					 )); ?>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
		
								<td valign="top">
                                                                    <p class="note">Fields with <span class="required">*</span> are required.</p>
                                                                                <div class="row">
											<?php echo $form->labelEx($user,'username'); ?>
											<?php echo $form->textField($user,'username',array('size'=>38)); ?>
											<?php echo $form->error($user,'username'); ?>
										</div>
                                                                                
                                                                                 <div class="row">
											<?php echo $form->labelEx($user,'email'); ?>
											<?php echo $form->textField($user,'email',array('required'=>true,'size'=>38)); ?>
											<?php echo $form->error($user,'email'); ?>
										</div>
										
										<div class="row">
											<?php echo $form->labelEx($model,'name'); ?>
											<?php echo $form->textField($model,'name',array('required'=>true,'size'=>60,'maxlength'=>255)); ?>
											<?php echo $form->error($model,'name'); ?>
										</div>
                                                                                
                                                                                <div class="row">
											<?php echo $form->labelEx($model,'mobile_no'); ?>
											<?php echo $form->textField($model,'mobile_no',array('required'=>true,'size'=>38)); ?>
											<?php echo $form->error($model,'mobile_no'); ?>
										</div>
                                                                    
                                                                                 <div class="row">
                                                                                     <?php echo $form->labelEx($tax,'tax'); ?>
                                                                                     <?php $tax = MerchantSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id)); ?>
                                                                                     <?php if ($tax){?>
											<?php echo $form->textField($tax,'tax',array('size'=>38)); ?>
											<?php } else {?> 
                                                                                         <?php $tax = new MerchantSettings;
                                                                                         echo $form->textField($tax,'tax',array('size'=>38));
                                                                                         ?>
                                                                                         <?php }?>
                                                                                     <?php echo $form->error($tax,'tax'); ?>
										</div>
                                                                    
                                                                                <div class="row">
                                                                                     <?php echo $form->labelEx($tax,'vat'); ?>
                                                                                     <?php $tax = MerchantSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id)); ?>
                                                                                     <?php if ($tax){?>
											<?php echo $form->textField($tax,'vat',array('size'=>38)); ?>
											<?php } else {?> 
                                                                                         <?php $tax = new MerchantSettings;
                                                                                         echo $form->textField($tax,'vat',array('size'=>38));
                                                                                         ?>
                                                                                         <?php }?>
                                                                                     <?php echo $form->error($tax,'vat'); ?>
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
											<?php echo $form->labelEx($model,'street'); ?>
											<?php echo $form->textField($model,'street',array('size'=>60,'maxlength'=>255)); ?>
											<?php echo $form->error($model,'street'); ?>
										</div>
										<div class="row">
											<?php echo $form->labelEx($model,'city'); ?>
											<?php echo $form->dropDownList($model, 'city', 	Citylist::model()->getCityuserDropDown(), array('prompt'=>'Select City'));  ?>
											<?php echo $form->error($model,'city'); ?>
										</div>
                                                                                
<!--                                                                             <div class="row">
                                                                                 <?php //echo $form->labelEx($planmodel,'pricing_plan_id'); ?>
                                                                                 <?php  //$planmodel= Pricingplansusers::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
                                                                                      
                                                                                // if($planmodel){
                                                                                    // $list = CMap::mergeArray(array(''=>'- Select -'), CHtml::listData(Pricingplans::model()->findAll(array('order' => 'name')), 'id', 'name'));
                                                                               //  echo CHTML::dropDownList('Pricingplansusers[pricing_plan_id]',$planmodel->pricing_plan_id, $list,array('id'=>'Pricingplansusers_pricing_plan_id',)); 
                                                                               // echo $form->error($planmodel,'pricing_plan_id'); 
                                                                                    //  }
                                                                                    //  else {
                                                                                        //  $planmodel =new Pricingplansusers;
                                                                                 ?>//
                                                                                 <?php //$list = CMap::mergeArray(array(''=>'- Select -'), CHtml::listData(Pricingplans::model()->findAll(array('order' => 'name')), 'id', 'name'));
                                                                                           // echo $form->dropDownList($planmodel,'pricing_plan_id',$list);  ?>
                                                                                 <?php //}?>
                                                                              <?php// echo $form->error($planmodel,'pricing_plan_id'); ?>
                                                                                 
                                                                            </div>-->
                                                                                
                                                                                
										<div class="buttons">
											<?php echo CHtml::submitButton('Save'); ?>
										</div>
										
				
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
                                                                                    <?php echo CHtml::submitButton('Remove', array('submit' => array('users/deleteavtar'),'confirm' => 'Are you sure want to delete this?')); ?>
										</div>
										<?php endif;?>
								</td>
						</tr>
				</table>
        <?php $this->endWidget(); ?>
		</div><!-- form -->
</div>
