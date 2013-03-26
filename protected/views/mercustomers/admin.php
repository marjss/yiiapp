<?php
/* @var $this MerseatsController */
/* @var $model Merseats */



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

<h1>Manage Customers</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="createnew"><?php echo CHtml::link('Create New',array('create')); ?></div>
<!--<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//));

$active = array(1=>'Active',0=>'Inactive');

$user_id = Yii::app()->user->id;


?>
</div><!-- search-form -->
<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
                'filter'=>$model,
//              'type'=>'striped bordered',
                'dataProvider' => $model->search(),
                //'template' => "{items}",
                'columns' => array_merge(array(
                                            array(
                                            'class'=>'bootstrap.widgets.TbRelationalColumn',
                                            'name' => 'name',
                                            'url' => $this->createUrl('mercustomers/appointments'),
                                            'value'=> $data->name,
//                                            'afterAjaxUpdate' => 'js:function(tr,rowid,data){
//                                            bootbox.alert("Following are the Details of the selected record:"+data); }'
                                                  )
                                            ),array(

		'mobile_no',
		'email',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}',
			'buttons'=>array
			(
			  'update' => array
			    (
				'label'=>'',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
                            ),
                         ),
		),
	)),
));?>
<?php /*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mercustomers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//array('name'=>'id','value'=>array($this,'getidadmin')),
		//'merchant_id',
		'name',
		'mobile_no',
		'email',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{appointments}',
			'buttons'=>array
			(
			    
			    'update' => array
			    (
				'label'=>'',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
				//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
			    ),
                            'appointments' => array
			    (
				'label'=>'',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
				'url'=>'Yii::app()->createUrl("mercustomers/appointments", array("id"=>$data->id))',
			    ),
			),
		),
	),
));*/ ?>
