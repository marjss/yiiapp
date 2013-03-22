<?php
/* @var $this GalleryController */
/* @var $data Gallery */?>
    <?php $this->widget('application.extensions.fancybox.EFancyBox', array(
                                                        'target'=>'a[rel=tooltip]',
                                                        'config'=>array(),
                                                                                )
                                                );?> 
<li class="span3" >
    <a href="<?php echo "/gallery/".CHtml::encode($data->user->username)."/".CHtml::encode($data->image) ;?>" class="thumbnail" rel="tooltip" data-title="Tooltip">
        <?php  echo CHtml::image("/gallery/".CHtml::encode($data->user->username)."/".CHtml::encode($data->image),array('height'=>100,'width'=>150));
//        echo CHtml::image(CHtml::encode($data->image));?>
       
    </a>
    <?php
    echo CHtml::link('Delete', $this->createUrl('gallery/delete', array('id' => CHtml::encode($data->id))), 
    array(
       // for htmlOptions
       'onclick' => ' {' . CHtml::ajax(array(
           'type'=>'POST',
           'url'=>$this->createUrl('gallery/delete', array('id' => CHtml::encode($data->id),'ajax'=>'delete')),
       'beforeSend' => 'js:function(){if(confirm("Are you sure you want to delete?"))return true;else return false;}',
       'complete'=>'js:function(jqXHR, textStatus){$.fn.yiiListView.update("gallery-grid");}',
       )) .
       'return false;}', // returning false prevents the default navigation to another url on a new page 
       'class' => 'delete',
       'id' => 'x' . CHtml::encode($data->id))
   ); ?>
</li>

<!--<div class="view">

	<b><?php //echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php e//cho CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php// echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php// echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php //echo CHtml::encode($data->image); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php //echo CHtml::encode($data->description); ?>
	<br />


</div>-->