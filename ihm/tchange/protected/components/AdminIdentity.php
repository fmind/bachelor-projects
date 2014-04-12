<?php

/**
 * AdminIdentity represents the data needed to identity an admin.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminIdentity extends CUserIdentity
{
    private $admins = array(
                'mederic'=>'TR0Cadm',
                'florent'=>'TR0Cadm',
                'quentin'=>'TR0Cadm',
            );

	/**
	 * Authenticates an admin.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		if(!isset($this->admins[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($this->admins[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
        
		return !$this->errorCode;
	}
}