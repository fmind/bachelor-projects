<?php

/**
 * UserIdentity represents the data needed to identity an user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates an user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        $user = Utilisateurs::model()->find('login=:username OR email=:username', array(':username'=>$this->username));

        if ($user === null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if ($user->mot_de_passe!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;

        if ($user) $this->username = $user->login;

		return !$this->errorCode;
	}
}