<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class CustomerForm extends CFormModel
{
	public $customer_name;
	public $customer_email;
	public $customer_contact_no;
	public $send_sms;
	public $send_email;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('customer_contact_no','numerical', 'integerOnly'=>true),
                        array('customer_contact_no','length', 'min'=>8 ),
			array('customer_name','length', 'min'=>3 ),
			//array('username, password, email,company', 'length', 'max'=>255),
			array('customer_name, customer_email,customer_contact_no ', 'length', 'max'=>255),
			array(' customer_name,customer_contact_no','required'),
//			array('customer_email','email'),
			array(' customer_email,customer_contact_no','safe'),
			//array('send_sms,send_email','checksendway'),
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
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
			'customer_name'=>'Customer Name',
			'customer_email'=> 'Customer Email',
			'customer_contact_no'=>'Customer mobile no'//I have read and agree to the terms
		);
	}
        
	public function checksendway($attribute)
	{
		if(!$this->terms)
			 $this->addError($attribute, 'You must agree to the Terms.');
		
	}
}
