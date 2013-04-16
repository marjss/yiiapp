<?php

class MercustomersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/controlpanel';

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
				'actions'=>array('create','update','admin','delete','index','view','Appointments'),
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
				     return 'Pending';
			     break;
                         
			     
		     }
	}
        public function actionAppointments($id){
         $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM dt_customer_orders')->queryScalar();
         $sql='SELECT co.service_name as Service, co.service_price as Price, co.service_duration as Duration ,cod.appointment_date_time as Appointment,cod.status as Status,st.name as Seat FROM dt_customer_orders cod, dt_customer_order_details co, dt_merchant_seats st WHERE cod.id = co.customer_order_id and cod.merchant_seat_id=st.id  and cod.customer_id='.$id;
	       $dataProvider=new CSqlDataProvider($sql, array(
//               'totalItemCount'=>$count,
                'pagination'=>array(
                    'pageSize'=>30,
                ),
            )); 
               
            $this->renderPartial('_orders', array(
                                    'id' => Yii::app()->getRequest()->getParam('id'),
                                    'dataProvider'=>$dataProvider,
                                    'order' => $order),false,false);
        
        }
}
