<?php
 
// this file must be stored in:
// protected/components/WebUser.php
 
class WebUser extends CWebUser {
 
  // Store model to not repeat query.
  private $_model;
 
  // Return first name.
  // access it by Yii::app()->user->first_name
 /*function getFirst_Name(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->first_name;
  }*/
 
  // This is a function that checks the field 'role'
  // in the User model to be equal to 1, that means it's admin
  // access it by Yii::app()->user->isAdmin()
 function isAdmin(){
    $user = $this->loadUser(Yii::app()->user->id);
    return intval($user->mas_role_id) == 1;
    
  }
  
  function isMerchant(){
      $user = $this->loadUser(Yii::app()->user->id);
      return intval($user->mas_role_id) == 2;
  }
  
  function adminEmail(){
     $setting = Settings::model()->findByAttributes(array('attribute'=>'admin_email'));
     return $setting->value;
  }
 //Loads the merchant contact number for action forgot password
  function merchantcontactno($email){
      $record=Users::model()->findByAttributes(array('email'=>$email));
      $usernum= UserDetails::model()->findByAttributes(array('user_id'=>$record->id));
      $non = "No Number Registered!";
      
      if($usernum){
      return $usernum->mobile_no;
      
      }else{ echo $non;
      }
  }
  
  // Load user model.
  protected function loadUser($id=null)
      {
	
	  if($this->_model===null)
	  {
	      if($id!==null)
		  $this->_model=Users::model()->findByPk($id);
	  }
	  return $this->_model;
      }
}
