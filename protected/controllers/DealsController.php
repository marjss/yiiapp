<?php

class DealsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
//	public $layout='//layouts/column2';
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','DeleteImage'),
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
         * Manage the Offers
         */
        public function actionOffers(){
            $this->layout = 'front_layout';
            $id= Yii::app()->user->id;
            echo $id;
            $services = Merservices::model()->findAllByAttributes(array('merchant_id'=>Yii::app()->user->id));;
           
          $this->render('offers',array(
			'services'=>$services,
		));
                       
        }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            $this->layout = 'front_layout';
		$model=new Deals;
                $merchantid= Yii::app()->user->id;
                $merchant = Merservices::model()->findByAttributes(array('merchant_id'=>$merchantid));
//                 print_r($merchant->price);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Deals']))
		{
                        $offerimg = $model->image;
			$model->attributes=$_POST['Deals'];
                        if($_FILES['Deals']['name']['image'] != '')
			{ 
                             
                            $model->image = CUploadedFile::getInstanceByName('Deals[image]');
                            if($model->validate()) 
                            {
                               
                                if ($model->image instanceof CUploadedFile) 
                                        {
                                        $rand = rand(0,3000);
                                        $imagename = 'offer' .'/'.  $merchantid .'_'.$rand. '_' . $_FILES['Deals']['name']['image'];
                                        $thumbimagename = 'offer' .'/thumb/'.  $merchantid.'_'.$rand . '_' . $_FILES['Deals']['name']['image'];
//                                        echo $thumbimagename;die;
                                        $model->image->saveAs($imagename);
                                        copy($imagename,$thumbimagename);
                                        //list($width, $height, $type, $attr) = getimagesize($filename);
                                        $image = Yii::app()->image->load($imagename);
                                        $image->resize(200, 200,Image::HEIGHT);
                                        $image->save();
                                        $image = Yii::app()->image->load($thumbimagename);
                                        $image->resize(100, 110);
                                        $image->save();
                                        $model->image = $imagename;
					}
                            }
                          }
			else
			{
				$model->image = $offerimg;
			}
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
                        'merchant'=>$merchant,
		));
	}
         /**
         * Delete the avtar image from admin view
         */
        public function actionDeleteImage($id){
            $this->layout = 'admin_layout';
            $model =$this->loadModel($id);
            $offerimg = $model->image;
		$filename = $offerimg;
		$thumbavtar    = explode("/",$filename);
		$thumbfilename = $thumbavtar[0]."/thumb/".$thumbavtar[1];
		unlink($filename);
		unlink($thumbfilename); 
		$model->image = '';
		if($model->save()){
                $avtarimage = Yii::app()->request->baseUrl."/avtar/no-image.png";
            echo '<img src='.$avtarimage.'>';  // this message will appear when ajax call finish.
                }else{
                    echo 'Error Removing image!';
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
                $merchantid= Yii::app()->user->id;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $offerimg = $model->image;
		if(isset($_POST['Deals']))
		{
			$model->attributes=$_POST['Deals'];if($_FILES['Deals']['name']['image'] != '')
			{ 
                             
                            $model->image = CUploadedFile::getInstanceByName('Deals[image]');
                            if($model->validate()) 
                            {
                               
                                if ($model->image instanceof CUploadedFile) 
                                        {
                                        $rand = rand(0,3000);
                                        $imagename = 'offer' .'/'.  $merchantid .'_'.$rand. '_' . $_FILES['Deals']['name']['image'];
                                        $thumbimagename = 'offer' .'/thumb/'.  $merchantid.'_'.$rand . '_' . $_FILES['Deals']['name']['image'];
//                                        echo $thumbimagename;die;
                                        $model->image->saveAs($imagename);
                                        copy($imagename,$thumbimagename);
                                        //list($width, $height, $type, $attr) = getimagesize($filename);
                                        $image = Yii::app()->image->load($imagename);
                                        $image->resize(200, 200,Image::HEIGHT);
                                        $image->save();
                                        $image = Yii::app()->image->load($thumbimagename);
                                        $image->resize(100, 110);
                                        $image->save();
                                        $model->image = $imagename;
					}
                            }
                          }
			else
			{
				$model->image = $offerimg;
			}
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
                $model =$this->loadModel($id);
                $offerimg = $model->image;
		$filename = $offerimg;
		$thumbavtar    = explode("/",$filename);
		$thumbfilename = $thumbavtar[0]."/thumb/".$thumbavtar[1];
		unlink($filename);
		unlink($thumbfilename); 
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
		$dataProvider=new CActiveDataProvider('Deals');
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
                $model=new Deals('search');
//		$model=  Deals::model()->findByAttributes(array('merchant_id'=>$merchant_id));
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Deals']))
			$model->attributes=$_GET['Deals'];
                
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
		$model=Deals::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='deals-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        /**
         * Get the Status of the deal/offer
         */
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
        
        public function imagePath($data,$row)
        {
            $no= "No Image";
            if($data->image){
            $path = "/".$data->image;
            return $path;}
            else{ echo $no; }
        }
}
