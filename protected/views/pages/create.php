<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pages', 'url'=>array('index')),
	array('label'=>'Manage Pages', 'url'=>array('admin')),
);
?>

<div id="merchant-setting-form">
	<h1 class="page-heading">Create Pages</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>