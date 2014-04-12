<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $login;
	public $password;
    public $isAdmin;

	private $_identity;

    public function __construct($admin=false)
    {
        parent::__construct();
        $this->isAdmin = $admin;
    }

	/**
	 * Declares the validation rules.
	 * The rules state that login and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// login and password are required
			array('login, password', 'required'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
            'login'=>'Identifiant',
            'password'=>'Mot de passe',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
        $this->_identity = ($this->isAdmin) ? new AdminIdentity($this->login,$this->password) : new UserIdentity($this->login,$this->password);

		if(!$this->hasErrors())
		{
			if(!$this->_identity->authenticate())
				$this->addError('password','Login ou mot de passe incorrect.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if ($this->_identity->errorCode===CUserIdentity::ERROR_NONE)
		{
			Yii::app()->user->login($this->_identity,3600*24*30);
			return true;
		}

        return false;
	}
}
