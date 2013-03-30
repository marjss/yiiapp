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

echo CHtml::link('Add Photo', '#', array('id' => 'upload-image'));
    
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
    <style>
        .thumbnail img{height: 100px; width:80%;}
        .item-class{
            width:200px;
        }
        .items li {
            float: left;
    height: 100px;
    margin-top: 20px;
    margin-bottom: 10px;
    width: 100px;list-style: none;}
        .item-class th{
            display: none;
        }
        .item-class .button-column{
            
        }
    </style>
</div><!-- search-form -->
<?php $this->widget('application.extensions.fancybox.EFancyBox', array(
                                                        'target'=>'a[rel=tooltip]',
                                                        'config'=>array(),
                                                                                )
                                                );?> 

<?php 
$this->widget('zii.widgets.CListView', array(
    'id'=>'gallery-grid',
    'dataProvider'=>$model->galsearch(),
//    'template'=>"{items}\n{pager}\n{delete}",
    'itemView'=>'_view',
     'afterAjaxUpdate'=>"function(id,data){ $('a[rel=tooltip]').fancybox(); }",
)); 
?>
<?php /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gallery-grid',
	'dataProvider'=>$model->galsearch(),
    'template'=>"{items}\n{pager}",
    'loadingCssClass'=>'gallery',
    'itemsCssClass'=>'item-class',
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		 array
			    (   
                     'type'=>'raw',
                     'header'=>'image',
                                
                                'name'=>'image',
                                'value'=>'CHtml::image("/gallery/".$data->user->username."/".$data->image)',

                               'value'=>array("/gallery/".$data->user->username."/".$data->image,'image'),
                               'htmlOptions'=>array('class'=>'thumb','rel'=>'gallery'),
				
			    ),
		'description',
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
));*/ ?>
