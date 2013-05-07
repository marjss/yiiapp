<?php
/* @var $this MerseatsController */
/* @var $model Merseats */

$this->pageTitle = 'Salon Chimp - Customers';

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
$('.export').click(function(){
        var checked = $('input[name=\"ids[]\"]:checked').length > 0;
        
//    if (!checked)
//        {       
//        alert('Please select atleast one SKU to export');
//        }else{
            document.getElementById('checked-export').action='export';
            document.getElementById('checked-export').submit();
//        }
       
});");
?>

<h1>Manage Customers</h1>
<script>

</script>
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<?php 

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'checked-export',
	//'enableAjaxValidation'=>true,
    'enableClientValidation'=>false,
    'htmlOptions'=>array('enctype' => 'multipart/form-data')
));

?>
<div class="createnew"><?php echo CHtml::link('Create New',array('create')); ?></div>
<!--<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//));

$active = array(1=>'Active',0=>'Inactive');

$user_id = Yii::app()->user->id;


?>
</div><!-- search-form -->
<div class="exportrep">		
<?php 
echo CHtml::button('Export', array('id'=>'export-button','class'=>'export')); 
// $this->renderExportGridButton('Export',array('class'=>'submit',)); ?>
    </div>
<?php
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
                'filter'=>$model,
//    'id'=>'dates-grid',
//    'itemsCssClass'=>'table table-striped table-bordered table-condensed',
//              'type'=>'striped bordered',
                'dataProvider' => $model->search(),
                //'template' => "{items}",
                 'pager'=>array(
'header'=>'',
'cssFile'=>true,
'maxButtonCount'=>25,
'selectedPageCssClass'=>'active',
'hiddenPageCssClass'=>'disabled',
'firstPageCssClass'=>'previous',
'lastPageCssClass'=>'next',
'firstPageLabel'=>'<<',
'lastPageLabel'=>'>>',
'prevPageLabel'=>'<',
'nextPageLabel'=>'>',
),
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
<?php 
$this->endWidget(); ?>