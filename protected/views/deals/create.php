<?php
/* @var $this DealsController */
/* @var $model Deals */
?>
<?php
$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
        'Offers'=>array('deals/admin'),
	'Create Offers / Deals',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links' => $this->breadcrumbs,
));
$this->menu=array(
	array('label'=>'List Deals', 'url'=>array('index')),
	array('label'=>'Manage Deals', 'url'=>array('admin')),
);
?>

<h1>Create Deals</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'merchant'=>$merchant)); ?>