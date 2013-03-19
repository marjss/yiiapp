<?php
/* @var $this MertimingsController */
/* @var $model Mertimings */

$this->breadcrumbs=array(
	'Mertimings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Mertimings', 'url'=>array('index')),
	array('label'=>'Manage Mertimings', 'url'=>array('admin')),
);
?>

<h1>Create Merchant Timings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>