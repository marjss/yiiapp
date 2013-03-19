<?php

class MertimingsController extends Controller
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
				'actions'=>array('create','update','admin','delete','index','view','Managetimings'),
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
		$model=new Mertimings;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Mertimings']))
		{
			//echo "<pre>"; print_r($_POST); die;
			$model->attributes=$_POST['Mertimings'];
			$model->opening_at = $_POST['opening_at'];
			$model->closing_at = $_POST['closing_at'];
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

		if(isset($_POST['Mertimings']))
		{
			echo "<pre>"; print_r($_POST); die;
			$model->attributes=$_POST['Mertimings'];
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
		$dataProvider=new CActiveDataProvider('Mertimings');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Mertimings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Mertimings']))
			$model->attributes=$_GET['Mertimings'];

		$this->render('managetimings',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionManagetimings()
	{
		
		$crit = new CDbCriteria;
		$crit->condition = "merchant_id = '".Yii::app()->user->id."' AND status = 1";
		$model= Mertimings::model()->findAll($crit);
		///$model->unsetAttributes();  // clear any default values
		
		if($_REQUEST['save']){
			//echo "<pre>"; print_r($_REQUEST); die;
			$days = array('mon'=>'Monday','tue'=>'Tuesday','wed'=>'Wednesday','thu'=>'Thrusday','fri'=>'Friday','sat'=>'Saturday','sun'=>'Sunday');
			$saveflag = 0;
			foreach($days as $key=>$val){
				//echo $_REQUEST["work_$key"]; 
				if(!$model){
					$mertiming = new Mertimings;
					if($_REQUEST["work_$key"] == 0)
					{
						$mertiming->merchant_id = Yii::app()->user->id;
						$mertiming->day = $key;
						$mertiming->opening_at = $_REQUEST["opening_at_$key"];
						$mertiming->closing_at = $_REQUEST["closing_at_$key"];
						$mertiming->off = 0;
						$mertiming->status = 1;
						if($mertiming->save()){
							$saveflag += 1;
						}
					}
					else{
						$mertiming->merchant_id = Yii::app()->user->id;
						$mertiming->day = $key;
						$mertiming->opening_at = '00:00:00';
						$mertiming->closing_at = '00:00:00';
						$mertiming->off = 1;
						$mertiming->status = 1;
						if($mertiming->save()){
							$saveflag += 1;
						}
					}
				}
				else{
					$mertiming = Mertimings::model()->findByAttributes(array('day'=>$key,'merchant_id'=>Yii::app()->user->id));
					if($_REQUEST["work_$key"] == 0)
					{
						$mertiming->merchant_id = Yii::app()->user->id;
						$mertiming->day = $key;
						$mertiming->opening_at = $_REQUEST["opening_at_$key"];
						$mertiming->closing_at = $_REQUEST["closing_at_$key"];
						$mertiming->off = 0;
						$mertiming->status = 1;
						if($mertiming->save()){
							$saveflag += 1;
						}
					}
					else{
						$mertiming->off = 1;
						if($mertiming->save()){
							$saveflag += 1;
						}
					}
				}
				//echo "<pre>"; print_r($mertiming); die;
				
			}
		}
		if($saveflag == 7){
			Yii::app()->user->setFlash('savetimings','Your timings is successfully saved.');
			$this->refresh();
		}
		
		
		if(isset($_GET['Mertimings']))
			$model->attributes=$_GET['Mertimings'];

		$this->render('managetimings',array(
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
		$model=Mertimings::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='mertimings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function getweekname($data,$row){
		switch($data->day)
		     {
			case 'mon':
				return 'Monday';
			break;
			case 'tue':
				return 'Tuesday';
			break;
			case 'wed':
			     return 'Wednesday';
			break;
			case 'thu':
			     return 'Thrusday';
			break;
			case 'fri':
			     return 'Friday';
			break;
			case 'sat':
			     return 'Saturday';
			break;
			case 'sun':
			     return 'Sunday';
			break;
			     
		     }
	}
}
