<?php
/* @var $this DealsController */
/* @var $model Deals */

$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
	'Offers',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));
$this->menu=array(
	array('label'=>'List Deals', 'url'=>array('index')),
	array('label'=>'Create Deals', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('deals-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Deals / Offers</h1>
 <style>
        .thumb {width: 100px;}
        .thumb img{height: 100px; width:80px;}
    </style>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="createnew"><?php echo CHtml::link('Create New',array('create')); ?></div>
<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//));
$active = array(1=>'Active',0=>'Inactive');
?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'deals-grid',
	'dataProvider'=>$model->mersearch(),
//	'filter'=>$model,
	'columns'=>array(
            /*array(
                'header'=>'Number',
                'value'=>'$row+1',       //  row is zero based
                    ),

		'id',*/
//		'merchant_id',
		'title',
		'description',
//                'price',
//		'offer_price',
		//'valid',
            
		array('header'=>'Valid Till','name'=>'valid','value'=>$data->valid),
		array('name' => 'status','value'=>array($this,'getStatus'),'filter' => $active,'sortable'=>TRUE),
		array
			    (   
                'name'=>'image',
                     'type'=>'image',
//                     'header'=>'image',
                     
//                                'name'=>'image',
                                'value'=>array($this,'imagePath'),
                                //'value'=>'$data["image"]',
                                'htmlOptions'=>array('class'=>'thumb','rel'=>'gallery'),
				
			    ),
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
			 'template'=>'{update}{delete}',
		),
	),
)); ?>
