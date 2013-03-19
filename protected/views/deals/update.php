<?php
/* @var $this DealsController */
/* @var $model Deals */
$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
        'Offers'=>array('deals/admin'),
	'Manage Offers / Deals',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));
/*$this->breadcrumbs=array(
	'Deals'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);
*/
$this->menu=array(
	array('label'=>'List Deals', 'url'=>array('index')),
	array('label'=>'Create Deals', 'url'=>array('create')),
	array('label'=>'View Deals', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Deals', 'url'=>array('admin')),
);
?>

<h1>Update Deals <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>