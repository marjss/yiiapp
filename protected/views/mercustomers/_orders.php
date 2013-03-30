
<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
'type'=>'striped bordered',
'dataProvider' => $dataProvider,
//'template' => "{items}",
    
'columns'=>array(       
                array('name'=>'Service','value'=>$data->Service),
                        'Price','Duration','Seat',
//		array('name'=>'customer_contact_no','value'=>$data->customer_contact_no),
//               array('name'=>'customerorder.service_duration','value'=>$data->customerorder->service_duration),
//              array('name'=>'Appointment', 'type' => 'raw','value'=>  $data->Appointment),
                array('header'=>'Appointment','value'=>'Yii::app()->dateFormatter->format("EEEE d MMMM y hh:mm:ss a", CDateTimeParser::parse($data["Appointment"], "yyyy-MM-dd H:mm:ss"))'),
//              array('name'=>$data->orderdetail->service_name,'value'=>$data->orderdetail->service_name),
//              array('name'=>'appointment_date_time','value'=>$data->appointment_date_time)
    ),
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
