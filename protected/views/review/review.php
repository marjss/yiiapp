<?php
/* @var $this ReviewController */
/* @var $model Review */

$this->breadcrumbs=array(
	'Reviews',
);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
));
?>

<?php
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
if($('#chk').length <= 0){
        alert('Please select atleast one Review to Approve');
        }else{
}        
       
");
?>

<div id="output"></div>
<h1>Manage Reviews</h1>
<div class="createnew">
    
    <?php echo CHtml::ajaxlink("Approve Selected",
$this->createUrl('/review/reviewsupdate'),
array("type" => "post",
"data" => "js:{chk:$.fn.yiiGridView.getSelection('reviewss-grid')}",
'update' => '#output',
'success' => 'js:function(data) { $.fn.yiiGridView.update("reviewss-grid")}',
    'beforeSend'=>'function(xhr,data){
        if(data.data == ""){
        alert("Select atleast one review to approve!");
        return false;
        }else{console.log(data);}}'
 ),
array( 'class'=>'button'
    )); ?>
    </div>
    <?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
    <!--<div class="createnew"><?php // echo CHtml::link('Create New',array('create')); ?></div>-->
    <!--<div class="search-form" style="display:none">
    </div>-->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reviewss-grid',
	'dataProvider'=>$model->newsearch(),
//	'filter'=>$model,
        'selectableRows' => 2,
	'columns'=>array(
            array(
                          'class'=>'CCheckBoxColumn',   
//                          'selectableRows'=>2,
                          'id'=>'chk',
                ), 
//            array(
//                        'class'=>'CCheckBoxColumn',
//                        'header'=>'CHEK',
//                        'value'=>'$data->id',
//                        'checkBoxHtmlOptions' => array(
//                        'name' => 'ids[]',
//                    ), ),
		//array('name'=>'id','value'=>'$row+1'),
		//'merchant_id',
		'name',
		'email',
                'review',
		array('name'=>'status','value'=>array($this,'getReviewStatus'),'filter' => DeemFun::getReviewStatus(),'sortable'=>TRUE),
		array(
			'class'=>'CButtonColumn',
                        'deleteConfirmation'=>"js:'Are you sure you want to delete this Review?It can not be removed permanently.' ",
			'buttons'=>array
			(
                            'approved' => array
			    (
				'label'=>'Approve',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/approve.png',
                                'url'=>'Yii::app()->createUrl("/review/Reviewsapprove", array("id"=>$data->id))',
                                'options' => array( 'ajax' => array(
                                                                    'url'=>'js:$(this).attr("href")',
                                                                    'data'=> "js:$(this).serialize()",
                                                                    'success'=>'js:function(data) { $.fn.yiiGridView.update("reviewss-grid")}',
                                         ),
                                'class'=>'approved',
                                        )),     
			    'update' => array
			    (
				'label'=>'',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
				//'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
			    ),
			    'deny' => array
			    (
				'label'=>'Deny',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/warning.png',
                                'url'=>'Yii::app()->createUrl("review/denyreview", array("id"=>$data->id))',
                                'options' => array( 'ajax' => array(
                                                                    'url'=>'js:$(this).attr("href")',
                                                                    'data'=> "js:$(this).serialize()",
                                                                    'success'=>'js:function(data) { $.fn.yiiGridView.update("reviewss-grid")}',
                                         ),
                                 'class'=>'Deny',
                                        )),
                            'delete' => array
			    (
				'label'=>'Delete',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
                                'url'=>'Yii::app()->createUrl("review/deletereview", array("id"=>$data->id))',
                                'options' => array( 'ajax' => array(
                                                                    'url'=>'js:$(this).attr("href")',
                                                                    'data'=> "js:$(this).serialize()",
                                                                    'success'=>'js:function(data) { $.fn.yiiGridView.update("reviewss-grid")}',
                                         ),
                                 'class'=>'Delete',
                                 'confirm' => 'Are you sure you want to delete this Review?It can not be removed permanently.',
                                        )),
			),
			 'template'=>'{approved}{deny}{delete}',
		),
	),
)); ?>
<?php // echo CHtml::ajaxButton('Approve', array('name' => 'ApproveButton','class'=>'check','confirm' => 'Are you sure you want to Approve these comments?')); ?>
    

