<?php
/* @var $this MerservicesController */
/* @var $model Merservices */

$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
	'Update ',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));

$this->menu=array(
	array('label'=>'List Merservices', 'url'=>array('index')),
	array('label'=>'Create Merservices', 'url'=>array('create')),
	array('label'=>'View Merservices', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Merservices', 'url'=>array('admin')),
);
?>
<div id="merchant-setting-form">
<h1>Update Services <?php //echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>