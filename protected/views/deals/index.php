<?php
/* @var $this DealsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Deals',
);

$this->menu=array(
	array('label'=>'Create Deals', 'url'=>array('create')),
	array('label'=>'Manage Deals', 'url'=>array('admin')),
);
?>

<h1>Deals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
