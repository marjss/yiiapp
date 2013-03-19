<?php
/* @var $this CategoryServiceController */
/* @var $model CategoryService */

$this->breadcrumbs=array(
	'Category Services'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List CategoryService', 'url'=>array('index')),
	array('label'=>'Create CategoryService', 'url'=>array('create')),
	array('label'=>'Update CategoryService', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CategoryService', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CategoryService', 'url'=>array('admin')),
);
?>

<h1>View CategoryService #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'added_date',
		'modified_date',
		array('name'=>'status','value'=>($model->status==1)?"Active":"Inactive"),
	),
)); ?>
