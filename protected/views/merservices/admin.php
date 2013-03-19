<?php
/* @var $this MerservicesController */
/* @var $model Merservices */

$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
	'Manage Services',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));

$this->menu=array(
	array('label'=>'List Merservices', 'url'=>array('index')),
	array('label'=>'Create Merservices', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('merservices-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Services</h1>

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
	'id'=>'merservices-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'selectableRows'=>true,
	'columns'=>array(
		//array('name'=>'id', 'value'=>'$row+1'),
		'name',
		array(
				'name'=>'cat_id',
				'filter' => CHtml::listData(CategoryService::model()->findAll(), 'id', 'title'), // fields from country table
				'value'=> 'CategoryService::Model()->FindByPk($data->cat_id)->title' //$data->catservice->title
				),
		array('name'=>'price','value'=>array($this,'getpriceadmin')),
		array('name'=>'duration','value'=>array($this,'getdurationadmin')),
		array('name'=>'status','value'=>array($this,'getStatus'),'filter' => $active,'sortable'=>TRUE),
                
            array(
			'class'=>'CButtonColumn',
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
