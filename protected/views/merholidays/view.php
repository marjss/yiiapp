<?php
/* @var $this MerholidaysController */
/* @var $model Merholidays */

$this->breadcrumbs=array(
	'Merholidays'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Merholidays', 'url'=>array('index')),
	array('label'=>'Create Merholidays', 'url'=>array('create')),
	array('label'=>'Update Merholidays', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Merholidays', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Merholidays', 'url'=>array('admin')),
);
?>

<h1>View #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'merchant_id',
		'name',
		'date',
		'status',
	),
)); ?>
