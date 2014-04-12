<?php

/**
 * This is the model class for table "Biens".
 *
 * The followings are the available columns in table 'Biens':
 * @property integer $id
 * @property string $nom
 * @property string $description
 * @property string $tags
 * @property integer $disponible
 * @property string $photo
 * @property string $date_creation
 * @property integer $sous_categorie
 * @property integer $utilisateur
 *
 * The followings are the available model relations:
 * @property SousCategories $sousCategorieRel
 * @property Utilisateurs $utilisateurRel
 * @property ChampValeurs[] $champs
 * @property Propositions[] $propositions
 */
class Biens extends CActiveRecord
{
    public static $path = "upload/biens/";

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Biens the static model class
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
		return 'Biens';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nom, description, sous_categorie, utilisateur', 'required'),
			array('disponible, sous_categorie, utilisateur', 'numerical', 'integerOnly'=>true),
			array('nom', 'length', 'max'=>128),
			array('photo', 'length', 'max'=>255, 'on' => 'proposer'),
            array('photo', 'file', 'types'=>'jpg, gif, png','on' => 'proposer'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('nom, description, disponible, date_creation, tags, sous_categorie, utilisateur', 'safe', 'on'=>'search, proposer, modifier'),
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
			'sousCategorieRel' => array(self::BELONGS_TO, 'SousCategories', 'sous_categorie'),
			'utilisateurRel' => array(self::BELONGS_TO, 'Utilisateurs', 'utilisateur'),
			'champs' => array(self::HAS_MANY, 'ChampValeurs', 'bien'),
			'propositions' => array(self::HAS_MANY, 'Propositions', 'bien'),
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
			'description' => 'Description',
            'tags' => 'Mot-clés',
			'disponible' => 'Disponible',
			'photo' => 'Photo',
			'date_creation' => 'Date de Création',
			'sous_categorie' => 'Sous-Catégorie',
			'utilisateur' => 'Utilisateur',
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
		$criteria->compare('description',$this->description,true);
        $criteria->compare('tags',$this->tags,true);
		$criteria->compare('disponible',$this->disponible);
		$criteria->compare('date_creation',$this->date_creation,true);
		$criteria->compare('sous_categorie',$this->sous_categorie);
		$criteria->compare('utilisateur',$this->utilisateur);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'date_creation DESC',
            ),
		));
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

    /**
     * Retourne le chemin "src" de la photo d'un bien
     * @param type $bien un bien
     */
    public static function getPhotoSrc($bien)
    {
        return DIRECTORY_SEPARATOR.self::$path.DIRECTORY_SEPARATOR.$bien->id.'.jpg';
    }
}