<?php
/* @var $this MerservicesController */
/* @var $model Merservices */

$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
	'Create',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));

$this->menu=array(
	array('label'=>'List Merservices', 'url'=>array('index')),
	array('label'=>'Manage Merservices', 'url'=>array('admin')),
);
?>
<div id="merchant-setting-form">
<h1>Create Service</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>