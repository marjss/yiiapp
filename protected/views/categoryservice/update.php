<?php
/* @var $this CategoryServiceController */
/* @var $model CategoryService */

$this->breadcrumbs=array(
	'Category Services'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CategoryService', 'url'=>array('index')),
	array('label'=>'Create CategoryService', 'url'=>array('create')),
	array('label'=>'View CategoryService', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CategoryService', 'url'=>array('admin')),
);
?>

<h1>Update CategoryService <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>