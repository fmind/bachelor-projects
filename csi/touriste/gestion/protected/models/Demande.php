<?php

class Demande extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Demande the static model class
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
        return 'Demande';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NOCLIENT, NOSTAT, NOTYPH, NOTYPEPREST, ETATDEM, CODEATTENTE, DATDEM, DATEDEBUTRES, DATEFINRES, NBPERSRES', 'required'),
            array('NOCLIENT, NOSTAT, NOTYPH, NOTYPEPREST, CODEATTENTE', 'numerical', 'integerOnly'=>true),
            array('ETATDEM', 'length', 'max'=>30),
            array('ETATDEM', 'in', 'range' => array('en attente', 'validé', 'annulé', 'renvoie proposition')),
            array('DATDEM', 'date', 'format'=>'yyyy-M-d'),
            array('DATEDEBUTRES', 'date', 'format'=>'yyyy-M-d'),
            array('DATEFINRES', 'date', 'format'=>'yyyy-M-d'),
            array('DATEFINRES', 'date_apres'),
            array('DATEDEBUTRES', 'temps', 'on' => 'traitement'),
            array('NBPERSRES', 'numerical', 'min' => '1', 'max' => 15),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NDEM, NOCLIENT, NOSTAT, NOTYPH, NOTYPEPREST, ETATDEM, CODEATTENTE, DATDEM, DATEDEBUTRES, DATEFINRES, NBPERSRES', 'safe', 'on'=>'search'),
        );
    }

    /**
     * Vérifie que la date de fin soit après la date de début
     */
    public function date_apres($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            if (new Datetime($this->DATEFINRES) < new Datetime($this->DATEDEBUTRES))
                $this->addError($attribute, "La date de fin doit être après la date de début");
        }
    }

    /**
     * Date limite pour déposer une demande (15 jours)
     */
    public function temps($attribute, $params)
    {
        $limit = new Datetime();
        $limit->add(new DateInterval("P15D"));
        if (new Datetime($this->DATEDEBUTRES) < $limit)
            $this->addError($attribute, "Vous ne pouvez pas créer une demande débutant avant 15 jours (temps nécessaire pour le traitement)");
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'clientRel' => array(self::BELONGS_TO, 'Client', 'NOCLIENT'),
            'stationRel' => array(self::BELONGS_TO, 'Station', 'NOSTAT'),
            'typeHebergRel' => array(self::BELONGS_TO, 'TypeHeberg', 'NOTYPH'),
            'typePrestRel' => array(self::BELONGS_TO, 'TypePrest', 'NOTYPEPREST'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'NDEM' => 'N°',
            'NOCLIENT' => 'Client',
            'NOSTAT' => 'Station',
            'NOTYPH' => 'Type d \'hébergement',
            'NOTYPEPREST' => 'Type de prestataire',
            'ETATDEM' => 'État',
            'CODEATTENTE' => 'Code attente',
            'DATDEM' => 'Date',
            'DATEDEBUTRES' => 'Date de début',
            'DATEFINRES' => 'Date de fin',
            'NBPERSRES' => 'Nombre de personne',
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

        $criteria->compare('NDEM',$this->NDEM);
        $criteria->compare('NOCLIENT',$this->NOCLIENT);
        $criteria->compare('NOSTAT',$this->NOSTAT);
        $criteria->compare('NOTYPH',$this->NOTYPH);
        $criteria->compare('NOTYPEPREST',$this->NOTYPH);
        $criteria->compare('ETATDEM',$this->ETATDEM,true);
        $criteria->compare('CODEATTENTE',$this->CODEATTENTE);
        $criteria->compare('DATDEM',$this->DATDEM,true);
        $criteria->compare('DATEDEBUTRES',$this->DATDEM,true);
        $criteria->compare('DATEFINRES',$this->DATDEM,true);
        $criteria->compare('NBPERSRES',$this->DATDEM,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
