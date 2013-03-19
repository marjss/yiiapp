<?php
/* @var $this MerholidaysController */
/* @var $model Merholidays */
$this->pageTitle = 'Update Holidays';
$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
	'Update Holiday',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));

$this->menu=array(
	array('label'=>'List Merholidays', 'url'=>array('index')),
	array('label'=>'Create Merholidays', 'url'=>array('create')),
	array('label'=>'View Merholidays', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Merholidays', 'url'=>array('admin')),
);
?>
<div id="merchant-setting-form">
<h1>Update Holiday</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>