<?php

/**
 * This is the model class for table "Echanges".
 *
 * The followings are the available columns in table 'Echanges':
 * @property integer $id
 * @property integer $troqueur
 * @property integer $troque
 * @property integer $statut
 * @property integer $objet_demande
 * @property integer $objet_retenu
 * @property string $date_creation
 * @property string $date_motification
 *
 * The followings are the available model relations:
 * @property Utilisateurs $troqueurRel
 * @property Utilisateurs $troqueRel
 * @property Biens $objetDemandeRel
 * @property Biens $objetRetenuRel
 */
class Echanges extends CActiveRecord
{
    // Types d'échanges
    public static $SELECTION = 0;       // Demande initiale du troqueur
    public static $PROPOSITION = 1;     // Liste de proposition du troqué
    public static $ACCEPTE = 2;         // Le troqueur accepte une proposition
    public static $REFUSE = -1;         // Le troqueur refuse l'échange ou les propositions

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Echanges the static model class
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
		return 'Echanges';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('troqueur, troque, objet_demande', 'required'),
			array('troqueur, troque, statut, objet_demande, objet_retenu', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('troqueur, troque, statut, objet_demande, objet_retenu, date_creation, date_modification', 'safe', 'on'=>'search'),
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
			'troqueurRel' => array(self::BELONGS_TO, 'Utilisateurs', 'troqueur'),
			'troqueRel' => array(self::BELONGS_TO, 'Utilisateurs', 'troque'),
			'objetDemandeRel' => array(self::BELONGS_TO, 'Biens', 'objet_demande'),
			'objetRetenuRel' => array(self::BELONGS_TO, 'Biens', 'objet_retenu'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'troqueur' => 'Troqueur',
			'troque' => 'Troqué',
			'statut' => 'Statut',
			'objet_demande' => 'Objet Demandé',
			'objet_retenu' => 'Objet Retenu',
			'date_creation' => 'Date de Creation',
			'date_modification' => 'Date de Modification',
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

		$criteria->compare('troqueur',$this->troqueur);
		$criteria->compare('troque',$this->troque);
		$criteria->compare('statut',$this->statut);
		$criteria->compare('objet_demande',$this->objet_demande);
		$criteria->compare('objet_retenu',$this->objet_retenu);
		$criteria->compare('date_creation',$this->date_creation);
		$criteria->compare('date_modification',$this->date_motification);

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
            $this->date_creation = $this->date_modification = date('Y-m-d H:i:s');
        $this->date_modification = date('Y-m-d H:i:s');

        return parent::beforeSave();
    }
}