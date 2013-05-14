<?php
/* @var $this MerseatsController */
/* @var $model Merseats */

$this->breadcrumbs=array(
	'Settings'=>array('users/settings'),
	'Stylists',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));

$this->menu=array(
	array('label'=>'List Merseats', 'url'=>array('index')),
	array('label'=>'Create Merseats', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('merseats-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Stylists</h1>
<?php if(Yii::app()->user->hasFlash('style')){ ?>
        
<div class="flash-success">
   	<?php echo Yii::app()->user->getFlash('style'); ?>
</div>
<?php }?>
<?php

$active = array(1=>'Active',0=>'Inactive');

$user_id = Yii::app()->user->id;

$userplan = Pricingplansusers::model()->findByAttributes(array('user_id'=>$user_id,'status'=>1));
if(count($seats) < $userplan->pricingplan->stylists){
?>

	<div class="createnew"><?php echo CHtml::link('Create New',array('create')); ?></div>
<?php 
}

?>
			

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'merseats-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
                
		//array('name'=>'id','value'=>array($this,'getidadmin')),
		//'merchant_id',
		//array('name'=>'stylist_id', 'value'=>'$data->users->name','filter' => CHtml::listData(Users::model()->findAll($crit),'id','username') ,'sortable'=>TRUE),
		'name',
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
