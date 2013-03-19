<style>
      
#merchant-setting-form form a {
    background: none !important;
    border: medium none;
    border-radius: 5px 5px 5px 5px;
    color: #FFFFFF;
    cursor: pointer;
    font-family: 'BebasNeue';
    font-size: 20px;
    letter-spacing: 2px;
    padding: 5px 10px;
}
#merchant-setting-form form a:hover {
    background: none repeat scroll 0 0 #D3D3D3 !important;
    
}
    .redactor_btn_image , .redactor_btn_file{
        display: none !important;
    }
</style>

<?php
$this->breadcrumbs = array(
    'Settings' => array('users/settings'),
    'Manage Description',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links' => $this->breadcrumbs,
));
?>

<div id="merchant-setting-form">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'description-form',
	'enableAjaxValidation'=>false,
)); ?>

	<table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>

                <td valign="top">
<!--                    <p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<?php echo $form->errorSummary($model); ?>
                    <?php if(Yii::app()->user->hasFlash('success')){?>
        <div class="info">
        <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
        <?php }?>
                    <?php echo $form->hiddenField($model->users,'id'); ?>
                    <div class="row"><br /> <br /></div>
	 <div class="row">
             <?php  
//             $this->widget('ext.alohaeditor.AlohaEditor', 
//                     array( 'model' => $model, 
//                         'attribute' => 'description',
//                         'toolbar' =>'basic', 
//                         'showTextarea' => true,
//                         'value' => 'description' 
//                         ));

             
             
             ?>
             
          <?php 
         $this->widget('ext.redactorjs.Redactor', 
                  array( 
                      'model' => $model, 
                      'attribute' => 'description',
//                      'toolbar' => 'mini',
                      'editorOptions' => array( 
                'imageUpload' => false,
                
 
                        ),
                      
                      )); ?>
            
           <?php 
//           $this->widget('ext.TheCKEditor.TheCKEditorWidget',array(
//    'model'=>$model,                # Data-Model (form model)
//    'attribute'=>'description',         # Attribute in the Data-Model
//    'height'=>'400px',
//    'width'=>'100%',
////    'toolbarSet'=>'Basic',          # EXISTING(!) Toolbar (see: ckeditor.js)
//    'ckeditor'=>Yii::app()->basePath.'/../ckeditor/ckeditor.php',
//                                    # Path to ckeditor.php
//    'ckBasePath'=>Yii::app()->baseUrl.'/ckeditor/',
//                                    # Relative Path to the Editor (from Web-Root)
//    'css' => Yii::app()->baseUrl.'/css/index.css',
//                                    # Additional Parameters
//) ); ?>
          
		<?php //echo $form->labelEx($model,'description'); ?>
		<?php// echo $form->textArea($model,'description',array('size'=>60,'cols'=>20,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
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
