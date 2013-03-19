<?php
/* @var $this MerseatsController */
/* @var $model Merseats */


$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
	'Update '.$model->name,
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));

$this->menu=array(
	array('label'=>'List Merseats', 'url'=>array('index')),
	array('label'=>'Create Merseats', 'url'=>array('create')),
	array('label'=>'View Merseats', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Merseats', 'url'=>array('admin')),
);
?>
<div id="merchant-setting-form">
<h1>Update Merseats <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>