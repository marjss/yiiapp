<?php
/* @var $this ServicesController */
/* @var $model Services */

$this->breadcrumbs=array(
	'Services'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Services', 'url'=>array('index')),
	array('label'=>'Create Services', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('services-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Services</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'services-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//array('name'=>'id','value'=>array($this,'getidadmin')),
		'name',
		//'catservice.title',
		
            

		array(
				'name'=>'cat_id',
				'filter' => CHtml::listData(CategoryService::model()->findAll(), 'id', 'title'), // fields from country table
				'value'=> 'CategoryService::Model()->FindByPk($data->cat_id)->title' //$data->catservice->title
				),
		array('header'=>'Price (rs)', 
                    'name'=>'price',
                    'value'=>$data->price,
//                    array($this,'getpriceadmin')
                    ),
		array('header'=>'Duration (min)',
                    'name'=>'duration',
                    'value'=>$data->duration,
//                    array($this,'getdurationadmin')
                    
                    ),
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
