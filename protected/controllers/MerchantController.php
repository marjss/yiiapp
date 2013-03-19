<?php

class MerchantController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','Signup'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','ChangePassword'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin@admin.com'),
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
		$this->layout = 'admin_layout';
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	
	public function actionChangePassword()
	{
	
		
		$user_id = Yii::app()->user->id;
		//echo $user_id; die;
		$model = $this->loadModel($user_id);
		
		$modelpass = new ChangePassword;
		$uid = Yii::app()->user->id;
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='cpwd-form')
		{
			
			echo CActiveForm::validate($modelpass);
			Yii::app()->end();
		}
                
		if(isset($_POST['ChangePassword']))
		{
			$modelpass->attributes = $_POST['ChangePassword'];
			
			if($modelpass->validate())
			{
				//echo '<pre>'; print_r($_POST['ChangePassword']);die;
				$user= Users::model()->findByPk($_POST['ChangePassword']['id']);
				
				if(md5($modelpass->oldpassword) == $user->password)
				{
					$user->password = md5($modelpass->newpassword);
					if($user->save())
					{
						Yii::app()->user->setFlash('success','Password changed successfully ! ');
						$this->refresh();
						
					}
				}
				else
				{
					Yii::app()->user->setFlash('error','Incorrect old password ! ');
					$this->refresh();
				}
			}
                }
		//$this->layout='column3';
                $this->render('changepassword',array(
			'model'=>$model, 'modelpass'=>$modelpass, 'uid'=>$uid
				));
			
	}
	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreatestylists()
	{
		$this->layout = 'admin_layout';
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
                        $password = 'salonier';
			$model->password = md5($password);
			$model->activation_key = 0;
                        $model->mas_role_id = 3;
                        $model->merchant_id = Yii::app()->user->id;
			$model->status = 1;
			if($model->save()){
				$this->redirect(array('stylistlist','id'=>$model->id));
			}
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
	public function actionUpdatestylist($id)
	{
		$this->layout = 'admin_layout';
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
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
		$this->layout = 'admin_layout';
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
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout = 'admin_layout';
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

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
		$model=Users::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
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
	
	public function gettemplate($data,$row)
	{
	   switch($data->masrole->name)
		     {
			     case 'Admin':
				     return '{view}';
			     break;
			     default:
				     return '{view}{update}{delete}';
			     break;
			     
		     }
	}
	
	public function getidadmin($data,$row){
		return ++$row;
	}
	
	
}
