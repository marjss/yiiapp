<?php
/* @var $this PricingplansController */
/* @var $model Pricingplans */

$this->breadcrumbs=array(
	'Pricingplans'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pricingplans', 'url'=>array('index')),
	array('label'=>'Create Pricingplans', 'url'=>array('create')),
	array('label'=>'View Pricingplans', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Pricingplans', 'url'=>array('admin')),
);
?>

<h1>Update Pricingplans <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>