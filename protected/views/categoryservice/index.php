<?php
/* @var $this CategoryServiceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Category Services',
);

$this->menu=array(
	array('label'=>'Create CategoryService', 'url'=>array('create')),
	array('label'=>'Manage CategoryService', 'url'=>array('admin')),
);
?>

<h1>Category Services</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
