<?php
/* @var $this MerholidaysController */
/* @var $model Merholidays */

$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
	'Manage',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));
$this->menu=array(
	array('label'=>'List Merholidays', 'url'=>array('index')),
	array('label'=>'Create Merholidays', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('merholidays-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Holidays</h1>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="createnew"><?php echo CHtml::link('Create New',array('create')); ?></div>
<!--<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//));


$active = array(1=>'Active',0=>'Inactive');
?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'merholidays-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		//array('name'=>'id','value'=>'$row+1'),
		//'merchant_id',
		'name',
		'date',
		array('name'=>'status','value'=>array($this,'getStatus'),'filter' => $active,'sortable'=>TRUE),
		array(
			'class'=>'CButtonColumn',
                        'deleteConfirmation'=>"js:'Are you sure you want to delete this ?' ",
			'buttons'=>array
			(
			    
			    'update' => array
			    (
				'label'=>'',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
				//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
			    ),
			    'delete' => array
			    (
				'label'=>'',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
                                
				//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
			    ),
			),
			 'template'=>'{update}{delete}',
		),
	),
)); ?>
