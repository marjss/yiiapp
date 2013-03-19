<?php
/* @var $this MertimingsController */
/* @var $model Mertimings */

$this->breadcrumbs=array(
	'Mertimings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Mertimings', 'url'=>array('index')),
	array('label'=>'Create Mertimings', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('mertimings-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Merchant Timings</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
));
$active = array(1=>'Active',0=>'Inactive');

$days = array('mon'=>'Monday','tue'=>'Tuesday','wed'=>'Wednesday','thu'=>'Thrusday','fri'=>'Friday','sat'=>'Saturday','sun'=>'Sunday');

?>
</div><!-- search-form -->

<?php  $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mertimings-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'id','value'=>'$row+1'),
		array('name'=>'day','value'=>array($this,'getweekname'),'filter' => $days,'sortable'=>TRUE,array('width'=>'200px')),
		'opening_at',
		'closing_at',
		array('name'=>'status','filter' => $active,'sortable'=>TRUE),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
