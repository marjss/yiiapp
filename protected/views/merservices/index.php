<?php
/* @var $this MerservicesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Merservices',
);

$this->menu=array(
	array('label'=>'Create Merservices', 'url'=>array('create')),
	array('label'=>'Manage Merservices', 'url'=>array('admin')),
);
?>

<h1>Services</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
