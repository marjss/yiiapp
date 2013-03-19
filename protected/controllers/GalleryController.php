<?php

class GalleryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/front_layout';

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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
           
                $model=new Gallery;
                $id= Yii::app()->user->id;
                $user= Users::model()->findByPk($id);
                // Uncomment the following line if AJAX validation is needed
//		$this->performAjaxValidation($model);
               if(!isset($_GET['ajax']))
		{
                    
			$model->attributes=$_POST['Photo'];
			$images = CUploadedFile::getInstancesByName('image');
			if(isset($images) && count($images)> 0) 
			{  
                           
				foreach ($images as $image=>$pic) 
				{
                                    $path = Yii::getPathOfAlias('webroot').'/gallery/'.$user->username;
                                    $pathrel = Yii::getPathOfAlias('webroot').'/gallery/';
                                    if (!file_exists($path) && is_writeable($pathrel)) {
                                       mkdir(Yii::getPathOfAlias('webroot').'/gallery/'.$user->username, 0777);
                                   }
                    			if ($pic->saveAs(Yii::getPathOfAlias('webroot').'/gallery/'.$user->username.'/'.$pic->name)) 	
					{	
						$model->setIsNewRecord(true);
						$model->id = null;
                        			$model->image = $pic->name;
                                                $model->setAttribute('user_id',$id);
                                                $model->setAttribute('description',$_POST['Gallery']['description']);
                    	 			$model->save();
					}				
				}
        				$this->redirect(array('admin','id'=>$model->id));
			}
		}
		/*if(isset($_POST['Gallery']))
		{
			$model->attributes=$_POST['Gallery'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
                  */
                 /* Ajax Popup Request */
                    if( Yii::app()->request->isAjaxRequest )
                        {

                        $this->renderPartial('_form',array('model'=>$model),false,true);
                        //Yii::app()->end();

                        }else{
               
		$this->render('create',array(
			'model'=>$model,
		));
                }
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

		if(isset($_POST['Gallery']))
		{
			$model->attributes=$_POST['Gallery'];
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
                $model=$this->loadModel($id);
                $id= Yii::app()->user->id;
                $user= Users::model()->findByPk($id);
                $image = Yii::app()->request->baseUrl."/gallery/".$user->username."/".$model->image;
                $exploded    = explode("/",$image);
                $relpath= $exploded[1]."/".$exploded[2]."/".$exploded[3];
                if(unlink($relpath)){   
                    $model->delete();
                
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }
        
        }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Gallery');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
            $dataProvider=new CActiveDataProvider('Gallery');
		$model=new Gallery('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Gallery']))
			$model->attributes=$_GET['Gallery'];

		$this->render('admin',array(
			'model'=>$model,'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Gallery::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='gallery-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
