<?php
/* @var $this PricingplansController */
/* @var $model Pricingplans */

$this->breadcrumbs=array(
	'Pricingplans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pricingplans', 'url'=>array('index')),
	array('label'=>'Manage Pricingplans', 'url'=>array('admin')),
);
?>

<h1>Create Pricing Plans</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>