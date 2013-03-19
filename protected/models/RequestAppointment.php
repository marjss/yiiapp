<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class RequestAppointment extends CFormModel
{
	public $name;
	public $email;
	public $subject;
	public $body;
	public $mobileno;
        public $date;
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, email, subject, body,mobileno, date', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
			array('subject','checsubject'),
			array('name','checname'),
			array('body','checbody'),
                        array('date','checdate'),
			array('mobileno','checkmobile'),

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
		);
	}
	
	public function checsubject($attribute,$params)
	{
		if($this->subject === 'Subject')
		{
			$this->addError($attribute, 'Subject cannot be blank.');
		}
		
	}	
	public function checname($attribute,$params)
	{
		
		if($this->name === 'Name')
		{
			$this->addError($attribute, 'Name cannot be blank.');
		}
	}
	public function checkmobile($attribute,$params)
	{
		
		if($this->mobileno === 'Mobile No')
		{
			$this->addError($attribute, 'Mobile cannot be blank.');
		}
		
	}
	public function checbody($attribute,$params)
	{
		
		if($this->body === 'Message')
		{
			$this->addError($attribute, 'Message can not be blank.');
		}
		
	}
        public function checdate($attribute,$params)
	{
		
		if($this->date === 'Date')
		{
                    
			$this->addError($attribute, 'Date cannot be blank.');
		}
	}
}