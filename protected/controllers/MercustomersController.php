<?php

class MercustomersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/controlpanel';
        
        public function behaviors() {
        return array(
        'exportableGrid' => array(
            'class' => 'application.components.ExportableGridBehavior',
            'filename' => 'customers.csv',
            'csvDelimiter' => ';', //Excel friendly csv delimiter
            'attributes' => array('name','mobile_no','email'   ,),
            ));
}
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','index','view','Appointments','getservices','export'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->isMerchant()'
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Mercustomers;

		// Uncomment the following line if AJAX validation is needed
//		 $this->performAjaxValidation($model);

		if(isset($_POST['Mercustomers']))
		{
			$model->attributes=$_POST['Mercustomers'];
			$model->merchant_id = Yii::app()->user->id;
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Mercustomers']))
		{
			$model->attributes=$_POST['Mercustomers'];
			$model->merchant_id = Yii::app()->user->id;
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Mercustomers');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Mercustomers('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Mercustomers']))
			$model->attributes=$_GET['Mercustomers'];
                        $this->exportGrid($model); 
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Mercustomers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mercustomers-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	public function getStatus($data,$row)
	{
           switch($data->status)
            {
               case 1:
		return 'Active';
		break;
		case 0:
		return 'Inactive';
		break;
             }
	}
        public function getAppStatus($data,$row)
	{
           switch($data['Status'])
            
           
		     {
               
			     case 1:
				     return 'Active';
			     break;
			     case 0:
				     return 'Inactive';
			     break;
                            case 4:
				     return 'Completed';
			     break;
			     case 2:
				     return 'Cancelled';
			     break;
                         
			     
		     }
	}
        public function actionAppointments($id){
         $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM dt_customer_orders')->queryScalar();
         $sql='SELECT co.customer_order_id,co.service_name as Service, co.service_price as Price, co.service_duration as Duration ,cod.appointment_date_time as Appointment,cod.status as Status,st.name as Seat FROM dt_customer_orders cod, dt_customer_order_details co, dt_merchant_seats st WHERE cod.id = co.customer_order_id and cod.merchant_seat_id=st.id  and cod.customer_id='.$id;
	       $dataProvider=new CSqlDataProvider($sql, array(
//               'totalItemCount'=>$count,
                'pagination'=>array(
                    'pageSize'=>40,
                ),
            )); 
               
            $this->renderPartial('_orders', array(
                                    'id' => Yii::app()->getRequest()->getParam('id'),
                                    'dataProvider'=>$dataProvider,
                                    'order' => $order),false,false);
        
        }
        public function getServices($data,$row){
//            $sql = 'select * from dt_customer_orders ';
            
            var_dump($data);
            
            
        }

        /*
         * Export the Admin Grid  to a XLS format file 
         * 
         */
        public function actionExport(){
            $id= Yii::app()->user->id;
            $model=  Mercustomers::model()->findAllByAttributes(array('merchant_id'=>$id));
            $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');

             // Turn off our amazing library autoload
             spl_autoload_unregister(array('YiiBase','autoload'));
             
             
             // making use of our reference, include the main class
             // when we do this, phpExcel has its own autoload registration
             // procedure (PHPExcel_Autoloader::Register();)
             include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

             // Create new PHPExcel object
             $objPHPExcel = new PHPExcel();
         
             // Set properties
            $objPHPExcel->getProperties()->setCreator("Salon Chimp")
            ->setLastModifiedBy("Salon Chimp")
            ->setTitle("Excel Export Document")
            ->setSubject("Excel Export Document")
            ->setDescription("Exporting documents to Excel using php classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Excel export file");
            

            //Getting the Active data
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Name')
                    ->setCellValue('B1', 'Mobile')
                    ->setCellValue('C1', 'Email')
                    
                   ;
                    //merging the cell in one     
//                    $objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
                    $i =0;
                        foreach($model as $data){
                            $name[] = $data->name;
                            $mobile[] = $data->mobile_no;
                            $email[] =  $data->email;
                            $i++;
                        }
                    for($k=2; $k<= $i; $k++){
                        $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$k, $name[$k-2])
                        ->setCellValue('B'.$k, $mobile[$k-2])
                        ->setCellValue('C'.$k, $email[$k-2])    
                            
                            ;
                    }
          $styleArray = array(
                    'font' => array(
                            'bold' => true,
                    ),
                    'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    ),
            );
           $styleArrayalign = array(
                    'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    ),
            );
            
            //background color for the cells
            $styleBackColor = array(
                     'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb'=>'E1E0F7'),
                        ),
                    'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    ),
            );
            
            $styleThinBorderOutline = array(
                    'borders' => array(
                        'outline' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                'color' => array('argb' => 'FF000000'),

                        ),
                    ),
           );
          
          //setting style for thick border
          $styleThickBorderbottom = array(
                    'borders' => array(
                        'bottom' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THICK,
                                'color' => array('argb' => 'FF000000'),

                        ),
                    ),
           );
          

          //setting style for thin bottom
          $styleThinBlackBorderbottom = array(
                'borders' => array(
                    'bottom' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => 'FF000000'),

                    ),
                ),
          );
         
          //setting the white space between the row cells
           $styleThickWhiteSpace = array(
                'borders' => array(
                    'top' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THICK,
                            'color' => array('argb' => 'FFFFFFFF'),

                    ),
                ),
          );
          
          //setting style for thin right
          $styleThickBlackBorderright = array(
                'borders' => array(
                    'right' => array(
                            'style' =>  PHPExcel_Style_Border::BORDER_THICK,
                            'color' => array('argb' => 'FF000000'),

                    ),
                ),
          );
          //setting style for thin left
          $styleThickBlackBorderleft = array(
                'borders' => array(
                    'left' => array(
                            'style' =>  PHPExcel_Style_Border::BORDER_THICK,
                            'color' => array('argb' => 'FF000000'),

                    ),
                ),
          );
          //Font size for whole sheet except headings
          $objPHPExcel->getDefaultStyle()->getFont()->setSize(8);
          
          
          //Font Style in heading section
          $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true)->setSize(11);
          $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
          $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
          $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(29);
          $objPHPExcel->getActiveSheet()->getStyle('A2:A500')->applyFromArray($styleArrayalign);
          $objPHPExcel->getActiveSheet()->getStyle('B2:B500')->applyFromArray($styleArrayalign);
          $objPHPExcel->getActiveSheet()->getStyle('C2:C500')->applyFromArray($styleArrayalign);
          $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleBackColor);
          
          
          /*
           *  Underline on the selected cells to highlight
           */
          
          $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleThinBlackBorderbottom);
                    
          /*
           * White space above the colored cell to show the seperator
           */
          
          $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleThickWhiteSpace);
          
          
          /*
           * Outline the Heading Cells
           */
          
          $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleThinBorderOutline);
          
         /*Set the Print layout to standard A4 Paper Size
             */
          $objPHPExcel->getActiveSheet(0)->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
             
          
          // Set active sheet index to the first sheet,  
            $objPHPExcel->setActiveSheetIndex(0);
           
          // Redirect output to a client's web browser (Excel2007)
          //$objWorksheet=$objPHPexcel->setActiveSheetIndex(0)->setShowGridlines(false);
          header('Content-Type: application/xls');
          header('Content-Disposition: attachment;filename="Customers.xls"');
          header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
          
          $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
          $objWriter->save('php://output');
          Yii::app()->end();

           // Once we have finished using the library, give back the
           // power to Yii...
           spl_autoload_register(array('YiiBase','autoload'));
        }
        
        
}
