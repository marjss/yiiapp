<?php
/* @var $this MertimingsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mertimings',
);

$this->menu=array(
	array('label'=>'Create Mertimings', 'url'=>array('create')),
	array('label'=>'Manage Mertimings', 'url'=>array('admin')),
);
?>

<h1>Mertimings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
