<?php

/**
 * This is the model class for table "Utilisateurs".
 *
 * The followings are the available columns in table 'Utilisateurs':
 * @property integer $id
 * @property string $nom
 * @property string $prenom
 * @property string $login
 * @property string $email
 * @property string $mot_de_passe
 * @property integer $profil
 * @property string $date_creation
 *
 * The followings are the available model relations:
 * @property Biens[] $biens
 * @property Messages[] $messages
 * @property Messages[] $mesMessages
 * @property Notifications[] $notifications
 */
class Utilisateurs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Utilisateurs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Utilisateurs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nom, prenom, login, email, mot_de_passe', 'required'),
			array('profil', 'numerical', 'integerOnly'=>true),
			array('nom, prenom', 'length', 'max'=>100),
			array('login, mot_de_passe', 'length', 'max'=>30),
            array('login', 'unique'),
			array('email', 'length', 'max'=>128),
            array('email', 'unique'),
            array('email', 'email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nom, prenom, login, email, profil, date_creation', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'biens' => array(self::HAS_MANY, 'Biens', 'utilisateur', 'order' => 'Biens.date_creation DESC'),
			'messages' => array(self::HAS_MANY, 'Messages', 'destinataire', 'order' => 'date_envoie. DESC'),
			'mesMessages' => array(self::HAS_MANY, 'Messages', 'source', 'order' => 'Messages.date_envoie DESC'),
			'notifications' => array(self::HAS_MANY, 'Notifications', 'destinataire', 'order' => 'Notifications.date_envoie DESC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nom' => 'Nom',
			'prenom' => 'Prénom',
			'login' => 'Login',
			'email' => 'Email',
			'mot_de_passe' => 'Mot de Passe',
			'profil' => 'Profil',
			'date_creation' => 'Date de Création',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('nom',$this->nom,true);
		$criteria->compare('prenom',$this->prenom,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('profil',$this->profil);
		$criteria->compare('date_creation',$this->date_creation);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'date_creation DESC',
            ),
		));
	}

    /**
     * Retourne l'utilisateur connecté
     */
    public static function connecte()
    {
        return Utilisateurs::model()->find('login=:username', array(':username'=>Yii::app()->user->id));
    }

    /**
     * Triggered on create and update
     */
    protected function beforeSave()
    {
        if ($this->isNewRecord)
            $this->date_creation = date('Y-m-d H:i:s');

        return parent::beforeSave();
    }
}