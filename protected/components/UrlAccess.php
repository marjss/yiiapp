<?php
class UrlAccess extends CUrlManager {

       /* public function init() {
            if(Yii::app()->user->id){
                $record = Users::model()->findByPk(Yii::app()->user->id);
                
                $this->createUrl('users/appointment?user='.$record->username);
            }
            // controllers allowed to be accessed from subdomains
           $subdomainAllowed = array('users', 'mercustomer', 'etc.');

            // controllers allowed to be accessed from the main domain
            $domainAllowed = array('users', 'site', 'etc.');

            // check if the path has "controller/action" pattern and assign the first element to $controller
            // i.e. company.website.com/clients/new
            
            if(strpos(Yii::app()->request->pathInfo, '/')) {
                $pathInfo = explode('/', Yii::app()->request->pathInfo);
                $controller = $pathInfo[0];
            }
            // if the path has only controller and no action specified (i.e. company.website.com/clients)
            else {
                $controller = Yii::app()->request->pathInfo;
            }
            
            $urlExplode = explode('.', $_SERVER['HTTP_HOST']);

            // check if this is a subdomain
            if(count($urlExplode) > 2 && $urlExplode[0] !== 'www') {
                // check if the controller specified in the path is allowed to be accessed from subdomain
                if(in_array(strtolower($controller), $subdomainAllowed)) {
                    return true;
                }
                else {
                    throw new CHttpException('404', 'Page not found');
                }
            }
           
            // etc.
            
        }
       */
        
        public function createUrl($route,$params=array(),$ampersand='&')
        {
          
            if(Yii::app()->user->id){
                $record = Users::model()->findByPk(Yii::app()->user->id);
                $route['user']=$record->username;
               // echo "<pre>"; print_r($route); die;
                //$this->createUrl('users/appointment?user='.$record->username);
            }
            return parent::createUrl($route, $params, $ampersand);
        }
        
        // etc.
    }