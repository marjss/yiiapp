<style>
    .thumb img{
        height:50px;
        width:50px;
    }
</style>
<?php
/* @var $this GalleryController */
/* @var $model Gallery */
$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
	'Galleries',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));
$this->breadcrumbs=array(
	'Galleries'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Gallery', 'url'=>array('index')),
	array('label'=>'Create Gallery', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('gallery-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Manage Gallery Images</h1>

<div class="createnew">
 <?php
    Yii::app()->clientScript->registerScript('uploadDialog', "
$(function(){
    $('#upload-image').click(function(){
        $('#gallery-form').load('".Yii::app()->createUrl('gallery/create')."', function(){
            $('#gallery-form').dialog('open');
        });
        return false;
    });
});");

echo CHtml::link('Upload', '#', array('id' => 'upload-image'));
    
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'gallery-form',
                'options'=>array(
                    'title'=>Yii::t('image','Upload'),
                    'autoOpen'=>false,
                    'model'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
    
    $this->endWidget('zii.widgets.jui.CJuiDialog');  ?>
    <?php // echo CHtml::link('Upload More',array('create')); ?>
</div>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gallery-grid',
	'dataProvider'=>$model->galsearch(),
//	'filter'=>$model,
	'columns'=>array(
		'id',
//		'user_id',
		 array
			    (   
                     'type'=>'image',
//                     'header'=>'image',
//                                
                                'name'=>'image',
                               'value'=>'Yii::app()->request->baseUrl."/gallery/".$data->user->username."/".$data->image',
                               'htmlOptions'=>array('class'=>'thumb'),
				
			    ),
//		'description',
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array
			(
			    
			    'update' => array
			    (
				'label'=>'',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
				
			    ),
			    'delete' => array
			    (
				'label'=>'',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
				
			    ),
			),
			 'template'=>'{delete}',
		),
	),
)); ?>
