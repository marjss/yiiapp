<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_id;
	//public $email;
	
	public function authenticate()
	{
		//echo $this->username; die;
		/*$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);*/
		$ctiteria = new CDbCriteria;
		$ctiteria->condition = "email = '".$this->username."' OR username = '".$this->username."'";
		$record=Users::model()->find($ctiteria);
//		echo "<pre>";print_r($record->attributes);die;
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
		else if ($record->status != 1)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
	
        else if($record->password !== md5($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id = $record->id;
            $this->setState('title', $record->email);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;

	}
	public function getId()
	{
	    return $this->_id;
	}
}