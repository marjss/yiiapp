<?php
/* @var $this PricingplansController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pricingplans',
);

$this->menu=array(
	array('label'=>'Create Pricingplans', 'url'=>array('create')),
	array('label'=>'Manage Pricingplans', 'url'=>array('admin')),
);
?>

<h1>Pricingplans</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
