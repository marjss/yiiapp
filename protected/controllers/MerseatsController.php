<?php

class MerseatsController extends Controller
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
				'actions'=>array('create','update','admin','delete','index','view'),
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
            $id= Yii::app()->user->id;
            $plans= Pricingplansusers::model()->findByAttributes(array('user_id'=>$id));
            $seats= Merseats::model()->findAllByAttributes(array('merchant_id'=>$id));
            $pricing=Pricingplans::model()->findByPk($plans->pricing_plan_id);
            $i=0;
            foreach($seats as $i=>$models){$i++;} //Determines the total number of active seats
            $match = $pricing->stylists ;         //Loads the Number of allocated seats
          
           if($match > $i){                       //comparing the active seats with allocated seats
                $model=new Merseats;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Merseats']))
		{
			$model->attributes=$_POST['Merseats'];
			$model->merchant_id = Yii::app()->user->id;
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
                
                }else{
                $this->redirect('admin');}
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

		if(isset($_POST['Merseats']))
		{
			$model->attributes=$_POST['Merseats'];
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
		$dataProvider=new CActiveDataProvider('Merseats');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
    
		$merchant_id = Yii::app()->user->id;
		$model=new Merseats('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Merseats']))
			$model->attributes=$_GET['Merseats'];
		
		$crit = new CDbCriteria;
		$crit->condition = "merchant_id = '".$merchant_id."'";
		$seats = Merseats::model()->findAll($crit);
		
		if($_GET['flag'] == 'false')
			Yii::app()->user->setFlash('create_error','Your maximum seats limit reached,You cant create new one.');
		$this->render('admin',array(
			'model'=>$model,'seats'=>$seats
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Merseats::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='merseats-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function getidadmin($data,$row){
		return ++$row;
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
        
	
}
?>