<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Pages', 'url'=>array('index')),
	array('label'=>'Create Pages', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pages-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


   <h1 class="page-heading">Manage Pages</h1>
		  
	
		  
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pages-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'page_title',
		array('name'=>'content', 'value'=>'substr($data->content,0,50)'),
		/*
		'is_active',
		*/
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array
			(
			    'view' => array
			    (
				'label'=>'',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
				//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
			    ),
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
		),
	),
)); ?>
