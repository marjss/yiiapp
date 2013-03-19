<?php
/* @var $this MerseatsController */
/* @var $model Merseats */

$this->breadcrumbs=array(
	'Merseats'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Merseats', 'url'=>array('index')),
	array('label'=>'Create Merseats', 'url'=>array('create')),
	array('label'=>'Update Merseats', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Merseats', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Merseats', 'url'=>array('admin')),
);
?>

<h1>View Merseats #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'merchant_id',
		'stylist_id',
		'name',
		'status',
	),
)); ?>
