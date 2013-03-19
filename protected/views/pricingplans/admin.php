<?php
/* @var $this PricingplansController */
/* @var $model Pricingplans */

$this->breadcrumbs=array(
	'Pricingplans'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Pricingplans', 'url'=>array('index')),
	array('label'=>'Create Pricingplans', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pricingplans-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Pricing Plans</h1>

<?php// echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
));
for($i=1;$i<=50;$i++){
	$stylist_count[] = $i;
}
?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pricingplans-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'cost',
		'validity',
		'validity_type',
		//array('name'=>'stylists','filter' => $stylist_count),
		'stylists',
		/*
		'status',
		*/
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array
			(
			    
			    'update' => array
			    (
				'label'=>'',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
				//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
			    ),
			    'delete' => array
			    (
				'label'=>'',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
				//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
			    ),
			),
			 'template'=>'{update}{delete}',
		),
	),
)); ?>
