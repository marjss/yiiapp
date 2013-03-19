<?php
/* @var $this MerseatsController */
/* @var $model Merseats */
$this->pageTitle= 'Create Merchant Stylist';
$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
	'Create',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));

$this->menu=array(
	array('label'=>'List Merseats', 'url'=>array('index')),
	array('label'=>'Manage Merseats', 'url'=>array('admin')),
);
?>
<div id="merchant-setting-form">
<h1>Create Merchant Stylist</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>