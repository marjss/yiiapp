<?php

class MerservicesController extends Controller
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
				'actions'=>array('find','near'),
				'users'=>array('*')
			),
			
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
		$model=new Merservices;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Merservices']))
		{
			$model->attributes=$_POST['Merservices'];
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

		if(isset($_POST['Merservices']))
		{
			$model->attributes=$_POST['Merservices'];
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
		$dataProvider=new CActiveDataProvider('Merservices');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Merservices('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Merservices']))
			$model->attributes=$_GET['Merservices'];

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
		$model=Merservices::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='merservices-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	public function getdurationadmin($data,$row){
		return $data->duration.' min';
	}
	
	public function getpriceadmin($data,$row){
            
		return $data->price.' ₹';
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
	
	public function actionFind()
	{
		$q = $_GET['term'];
		if (isset($q)) {
		    $criteria = new CDbCriteria;
		    //condition to find your data, using q as the parameter field
		    $criteria->condition = "name LIKE :servicename";
		    //$criteria->addSearchCondition('n', $acc);
		    $criteria->limit = 10; // probably a good idea to limit the results
		    // with trailing wildcard only; probably a good idea for large volumes of data
		    $criteria->params = array(':servicename' => trim($q) . '%'); 
		    $services = Services::model()->findAll($criteria);
	  
		    if (!empty($services)) {
			$out = array();
			foreach ($services as $c) {
			    $out[] = array(
				// expression to give the string for the autoComplete drop-down
				'label' => $c->name,  
				'value' => $c->name,
				'id' => $c->id, // return value from autocomplete
				
			    );
			}
			echo CJSON::encode($out);
			Yii::app()->end();
		    }
		}
	}
	/**
         * Near By Home Page search action 
         */
        public function actionNear()
	{
		$q = $_GET['term'];
		if (isset($q)) {
		    $criteria = new CDbCriteria;
		    $criteria->compare('street',trim($q),true );
                    $criteria->distinct = true;
                    $criteria->group = 'street';
		    $criteria->limit = 10;
		    $street = UserDetails::model()->findAll($criteria);
                    
		    if (!empty($street)) {
			$out = array();
			foreach ($street as $c) {
			    $out[] = array(
				'label' => $c->street,  
				'value' => $c->street,
				'id' => $c->id, 
				
			    );
			}
			echo CJSON::encode($out);
			Yii::app()->end();
		    }
		}
	}
}
