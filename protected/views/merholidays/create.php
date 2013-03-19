<?php
/* @var $this MerholidaysController */
/* @var $model Merholidays */

$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
	'Create',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));
?>

<h1>Create Holiday</h1>
<div id="merchant-setting-form">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>