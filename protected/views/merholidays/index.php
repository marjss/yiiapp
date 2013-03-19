<?php
/* @var $this MerholidaysController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Merholidays',
);

$this->menu=array(
	array('label'=>'Create Merholidays', 'url'=>array('create')),
	array('label'=>'Manage Merholidays', 'url'=>array('admin')),
);
?>

<h1>Merholidays</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
