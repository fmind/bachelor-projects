<?php

/**
 * Formulaire d'inscription pour l'utilisateur final
 */
class InscriptionForm extends CFormModel
{
	public $nom;
	public $prenom;
    public $login;
    public $email;
    public $mot_de_passe;
    public $mot_de_passe_confirmation;
    public $profil;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('nom, prenom, login, email, mot_de_passe, mot_de_passe_confirmation, profil', 'required'),
			array('nom, prenom', 'length', 'max'=>100),
			array('login, mot_de_passe', 'length', 'max'=>30, 'min' => 4),
            array('email', 'length', 'max'=>128),
            array('login', 'unique', 'className' => 'Utilisateurs', 'attributeName' => 'login', 'on' => 'inscription'),
            array('email', 'unique', 'className' => 'Utilisateurs', 'attributeName' => 'email', 'on' => 'inscription'),
            array('email', 'email'),
            array('mot_de_passe_confirmation', 'compare', 'compareAttribute' => 'mot_de_passe'),
            array('profil', 'numerical', 'integerOnly'=>true),
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
			'nom' => 'Nom',
            'prenom' => 'Prénom',
            'login' => 'Login',
            'email' => 'Adresse email',
            'mot_de_passe' => "Mot de passe",
            'mot_de_passe_confirmation' => "Confirmation",
            'verifyCode' => "Code de vérification",
		);
	}
}