<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model
));
$active = array(1=>'Active',0=>'In Active');
?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('header'=>'S. No','value'=>array($this,'getidadmin')),
		 array('name'=>'mas_role_id', 
                     'value'=>'$data->masrole->name',
                     'filter' => CHtml::listData(Masroles::model()->findAll(),'id','name') ,
                     'sortable'=>TRUE),
//                     'id',
		'username',
		'email',
		array('name'=>'status','value'=>array($this,'getStatus'),'filter' => $active),
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array
			(
			    'update' => array
			    (
				'label'=>'',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
				//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
                                'options'=>array('title'=>'Update'),
			    ),
			    'delete' => array
			    (
				'label'=>'',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
				//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
                                'options'=>array('title'=>'Delete'),
			    ),
			),
			'template'=>'{update}{delete}',
			//'template'=>'($data->masrole->name == "Admin")? \'{view}',
		),
	),
)); ?>
