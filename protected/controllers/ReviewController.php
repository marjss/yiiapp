<?php

class ReviewController extends Controller
{
    public $layout = 'front_layout';
    // Uncomment the following methods and override them if needed {Sudhanshu}
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
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
                                    'actions'=>array('index','view','Reviewsub'),
                                    'users'=>array('*'),
                            ),
                            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                                    'actions'=>array('feedback','reviews','reviewsupdate','DenyReview','DeleteReview','Reviewsapprove'),
                                    'users'=>array('@'),
                                    //'redirect'=>Yii::app()->params['loginUrl'],
                            ),
                            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                                    'actions'=>array('admin','delete','create','update'),
                                    'users'=>array('admin@admin.com'),
                            ),
                            array('deny',  // deny all users
                                    'users'=>array('*'),
                            ),
                    );
              }
         /**
         * Controls the Users Reviews and feedback from shop page
         */
        public function actionReviews(){
            $merchant_id= Yii::app()->user->id;
            $model = new Review('search');
            $model->unsetAttributes();  // clear any default values
		if(isset($_GET['Review']))
			$model->attributes=$_GET['Review'];
            $this->render('review',array('model'=>$model));
            }
        
            /**
             * Bulk update action to approve the Reviews
             */
                public function actionReviewsupdate(){
                    if(isset($_POST['chk'])) {
                        foreach($_POST['chk'] as $val) {
                                $model= Review::model()->UpdateByPk($val,array('status'=>2));
                        }
                      }
                    }
            
            /**
             *Deny the respected user review from the merchant admin panel. 
             */
                public function actionDenyReview($id){
                    if(Yii::app()->request->isAjaxRequest){
                      $model= Review::model()->UpdateByPk($id,array('status'=>3));
                   }
                 }
            
            /**
             * Approve the user review one by one on merchant admin panel.
             */
                public function actionReviewsapprove($id){
                        if(Yii::app()->request->isAjaxRequest){
                             $model= Review::model()->UpdateByPk($id,array('status'=>2));
                       }
                    }
            
            /**
             * Delete the review but not physically removed, only the review status is changed to deleted. 
             */
                public function actionDeleteReview($id){
                  if(Yii::app()->request->isAjaxRequest){
                    $model= Review::model()->UpdateByPk($id,array('status'=>0));
                 }
               }
            
            /**
             * Function to return the review status on the merchant admin grid panel.
             */
                public function getReviewStatus($data,$row)
                {
                   switch($data->status)
                             {
                                case 0:
                                        return 'Deleted';
                                break;
                                case 1:
                                        return 'Pending';
                                break;

                                case 2:
                                        return 'Approved';
                                break;
                                case 3:
                                        return 'Denied';
                                break;

                             }
                }
            /**
             * Function for submitting the review from the Shop page
             */
                public function actionReviewsub($id)
                        {
                        if (isset($_POST['Review']))
                            {
                            $model = new Review;
                            $model->setAttributes($_POST['Review']);
                            $error = CActiveForm::validate($model, array('name','email','review',));
                               if($error=='[]')
                                   {
                                    $timezone = "Asia/Calcutta";
                                    date_default_timezone_set($timezone);
                                    $time= mktime();
                                    $model->setAttribute('date', $time);
                                    $model->setAttribute('status',1);
                                    if($model->save())
                                      {echo 'sent';die;}else{echo 'fail';die;}  
                                    }else{echo $error;}
                            }
                        }
}