<?php
/* @var $this MerseatsController */
/* @var $model Merseats */

$this->breadcrumbs=array(
	'Merseats'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Merseats', 'url'=>array('index')),
	array('label'=>'Manage Merseats', 'url'=>array('admin')),
);
?>
<div id="merchant-setting-form">
<h1>Create Customers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>