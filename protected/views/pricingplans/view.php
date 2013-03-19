<?php
/* @var $this PricingplansController */
/* @var $model Pricingplans */

$this->breadcrumbs=array(
	'Pricingplans'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Pricingplans', 'url'=>array('index')),
	array('label'=>'Create Pricingplans', 'url'=>array('create')),
	array('label'=>'Update Pricingplans', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Pricingplans', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pricingplans', 'url'=>array('admin')),
);
?>

<h1>View Pricingplans #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'cost',
		'validity',
		'validity_type',
		'stylists',
		'status',
	),
)); ?>
