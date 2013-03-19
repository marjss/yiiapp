<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class UserRegister extends CFormModel
{
	public $username;
	public $email;
	public $password;
	public $confirm_password;
	public $name;
	public $mobile_no;
	public $city;
	public $terms;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('name, username','length', 'min'=>5),
                        array('mobile_no','numerical', 'integerOnly'=>true),
                        array('mobile_no','length', 'min'=>8 ),
                        array('password','length', 'min'=>8 ),
                        array('city','length', 'min'=>3 ),
                        array('password','match' ,'pattern'=>'/^[A-Za-z0-9_!@#$%^&*()+=?.,]+$/u', 'message'=>'Spaces or given characters are not allowed'),
			array('username, password,name ,city,mobile_no,email', 'length', 'max'=>255),
			array(' name,username,email, password, confirm_password,mobile_no,city','required'),
			array('email','email'),
			array('username','checkuniquename'),
			array(' email','checkuniqueemail'),
			array('confirm_password', 'compare', 'compareAttribute'=>'password'),
			array('username','match' ,'pattern'=>'/^[A-Za-z0-9_]+$/u', 'message'=>'Username can contain only alphanumeric characters and hyphens(-).'),
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			array(' terms','checkterms'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'mobile_no'=>'Mobile no.',
			'name'=>'Business Name',
			'confirm_password'=> 'Confirm Password',
			'terms'=>'You must agree to the Terms'//I have read and agree to the terms
		);
	}
	
	public function checkuniquename($attribute)
	{
		$record=Users::model()->findByAttributes(array($attribute=>$this->username));
		if($record!==null)
			 $this->addError($attribute, 'This user name has been already taken please choose a different one');
			 
	}
	
	public function checkuniqueemail($attribute)
	{
		$record=Users::model()->findByAttributes(array($attribute=>$this->email));
		if($record!==null)
			 $this->addError($attribute, 'This email has been already taken please choose a different one');
		
	}
	
	public function checkterms($attribute)
	{
		if(!$this->terms)
			 $this->addError($attribute, 'You must agree to the Terms.');
		
	}
}
