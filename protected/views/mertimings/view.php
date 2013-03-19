<?php
/* @var $this MertimingsController */
/* @var $model Mertimings */

$this->breadcrumbs=array(
	'Mertimings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Mertimings', 'url'=>array('index')),
	array('label'=>'Create Mertimings', 'url'=>array('create')),
	array('label'=>'Update Mertimings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Mertimings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Mertimings', 'url'=>array('admin')),
);
?>

<h1>View Mertimings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'merchant_id',
		'day',
		'opening_at',
		'closing_at',
		'status',
	),
)); ?>
