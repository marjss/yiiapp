<?php
/* @var $this MerseatsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Merseats',
);

$this->menu=array(
	array('label'=>'Create Merseats', 'url'=>array('create')),
	array('label'=>'Manage Merseats', 'url'=>array('admin')),
);
?>

<h1>Seats</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
