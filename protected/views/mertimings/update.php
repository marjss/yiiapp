<?php
/* @var $this MertimingsController */
/* @var $model Mertimings */

$this->breadcrumbs=array(
	'Mertimings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Mertimings', 'url'=>array('index')),
	array('label'=>'Create Mertimings', 'url'=>array('create')),
	array('label'=>'View Mertimings', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Mertimings', 'url'=>array('admin')),
);
?>

<h1>Update Mertimings <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>