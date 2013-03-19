<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Pages', 'url'=>array('index')),
	array('label'=>'Create Pages', 'url'=>array('create')),
	array('label'=>'Update Pages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Pages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pages', 'url'=>array('admin')),
);
?>

<div class="admin-area">
   <div class="admindashboard-upper">
	<h1 class="page-heading">View Pages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'page_title',
//		'slug',
		 array(               // related city displayed as a link
		     'label'=>'Content',
		     'type'=>'html',
		     'cssClass'=>'pagecontent',
		     'value'=>$model->content,
		     
		 ),
		  array(               // related city displayed as a link
//		     'label'=>'Meta description',
//		     'type'=>'html',
//		     'cssClass'=>'metadescription',
//		     'value'=>$model->meta_description,
		 ),
//		'meta_keywords',
		'is_active',
	),
	
)); ?>
	</div>
   <?php  echo CHtml::link('Close',array('//pages/admin'),array('class'=>'closeimage')); ?>

</div>
