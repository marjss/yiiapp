<?php
/* @var $this CategoryServiceController */
/* @var $model CategoryService */

$this->breadcrumbs=array(
	'Category Services'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CategoryService', 'url'=>array('index')),
	array('label'=>'Manage CategoryService', 'url'=>array('admin')),
);
?>

<h1>Create CategoryService</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>