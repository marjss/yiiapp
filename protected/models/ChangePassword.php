<?php
/**
 * UserChangePassword class.
 * UserChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action 
 * of 'UserController'.
 */

class ChangePassword extends CFormModel 
{
    public $oldpassword;
    public $newpassword;
    public $retypepassword;
    public $id;

        public function rules() 
        {
                return  array(
                        array('oldpassword, newpassword, id, retypepassword', 'required'),
                        array('newpassword', 'length', 'max'=>20, 'min' => 4,
                                'message' => "Incorrect password (minimal length 4 charactors)."),
                        array('retypepassword', 'compare', 'compareAttribute'=>'newpassword',
                                'message' => "Retype password is incorrect."),
			     );
        }

        	
	
	/**
         * Declares attribute labels.
         */
        
	public function attributeLabels()
	{
		return array(
			'oldpassword' => 'Old Password',
			'newpassword' => 'New Password',
			'retypepassword' => 'Retype Password',
			'id'=> 'ID',
			);
	}
} 