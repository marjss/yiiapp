<?php
/* @var $this MerservicesController */
/* @var $model Merservices */

$this->breadcrumbs=array(
	'Merservices'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Merservices', 'url'=>array('index')),
	array('label'=>'Create Merservices', 'url'=>array('create')),
	array('label'=>'Update Merservices', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Merservices', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Merservices', 'url'=>array('admin')),
);
?>

<h1>View Services</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'merchant_id',
		'name',
		'description',
		'price',
		'duration',
		'status',
	),
)); ?>
