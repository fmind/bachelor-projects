<?php

class Reservation extends CActiveRecord
{
    public $mettre_en_attente = false;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Reservation the static model class
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
        return 'Reservation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NDEM, NOHEBERG, DATERES, MONTANTRES, ETATRES, ASSURANCE', 'required'),
            array('NDEM, NOHEBERG', 'numerical', 'integerOnly'=>true),
            array('NDEM', 'unique'),
            array('NOHEBERG', 'disponible'),
            array('MONTANTRES', 'numerical', 'min' => '1'),
            array('ETATRES', 'length', 'max'=>30),
            array('DATERES', 'date', 'format'=>'yyyy-M-d'),
            array('DATANNUL', 'date', 'format'=>'yyyy-M-d'),
            array('ETATRES', 'in', 'range' => array('en attente arrhes', 'effective', 'annule', 'refusé', 'complete')),
            array('ASSURANCE', 'boolean'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NORES, NDEM, NOHEBERG, DATERES, DATANNUL, MONTANTRES, DATANNUL, ETATRES, ASSURANCE', 'safe', 'on'=>'search'),
        );
    }

    /**
     * Vérifie si l'hébergement correspond aux critères et est disponible
     */
    public function disponible($attribute, $params)
    {
        if (!$this->hasErrors() && $this->scenario != "refus")
        {
            // Répond aux critères du client
            $demande = $this->demandeRel;
            $hebergement = $this->hebergementRel;
            $prestataire = $hebergement->prestataireRel;

            if ($prestataire->NOSTAT != $demande->NOSTAT) {
                $this->addError($attribute, "La station n'est pas adaptée à la demande");
                return;
            }
            if ($hebergement->NOTYPH != $demande->NOTYPH) {
                $this->addError($attribute, "Le type d'hébergement n'est pas adapté à la demande");
                return;
            }
            if ($prestataire->NOTYPP != $demande->NOTYPEPREST) {
                $this->addError($attribute, "Le type de prestataire n'est pas adapté à la demande");
                return;
            }

            // Mise à disposition pour la saison en cours
            $saison = Saison::model()->find(":datedebut BETWEEN DATEDEBS AND DATEFINS AND :datefin BETWEEN DATEDEBS AND DATEFINS ", array('datedebut' => $demande->DATEDEBUTRES, 'datefin' => $demande->DATEFINRES));
            $apour = APour::model()->find('NOHEBERG=:noheberg AND NOSAISON=:nosaison', array('noheberg' => $hebergement->NOHEBERG, 'nosaison' => $saison->NOSAISON));
            if (!$apour) {
                $this->addError($attribute, "L'hébergement n'est pas disponible pour la saison");
                return;
            }

            // Avec des disponibilités
            $test_dispo = false;
            $date_debut = new Datetime($demande->DATEDEBUTRES);
            $date_fin = new Datetime($demande->DATEFINRES);
            foreach ($hebergement->disponibilites as $dispo) {
                $date_debut_dispo = new Datetime($dispo->DATEDEBDISP);
                $date_fin_dispo = new Datetime($dispo->DATEFINDISP);

                if ($date_debut_dispo <= $date_debut && $date_fin <= $date_fin_dispo) {
                    $test_dispo = true;
                    break;
                }
            }
            if (!$test_dispo) {
                $this->addError($attribute, "L'hébergement n'est pas disponible sur la période de la demande");
                return;
            }

            // Non réservé
            $test_reserv = true;
            foreach (Reservation::model()->findAll('NOHEBERG='.$hebergement->NOHEBERG) as $reserv) {
                if ($reserv->NORES == $this->NORES) continue;

                $demande_reserv = $reserv->demandeRel;
                $date_debut_reserv = new Datetime($demande_reserv->DATEDEBUTRES);
                $date_fin_reserv = new Datetime($demande_reserv->DATEFINRES);

                if (($date_fin >= $date_debut_reserv && $date_fin <= $date_fin_reserv)
                || ($date_debut >= $date_debut_reserv && $date_debut <= $date_fin_reserv)
                || ($date_debut_reserv >= $date_debut && $date_debut_reserv <= $date_fin)
                || ($date_fin_reserv >= $date_debut && $date_fin_reserv <= $date_fin)) {
                    $test_reserv = false;
                    break;
                }
            }
            if (!$test_reserv) {
                $this->addError($attribute, "L'hébergement a déjà été réservé sur la période de la demande");
                return;
            }
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'demandeRel' => array(self::BELONGS_TO, 'Demande', 'NDEM'),
            'hebergementRel' => array(self::BELONGS_TO, 'Hebergement', 'NOHEBERG'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'NORES' => 'N°',
            'NDEM' => 'N° Demande',
            'NOHEBERG' => 'N° Hébergement',
            'DATERES' => 'Date',
            'MONTANTRES' => 'Montant',
            'DATANNUL' => 'Date annulation',
            'ETATRES' => 'État',
            'ASSURANCE' => 'Avec Assurance',
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

        $criteria->compare('NORES',$this->NORES);
        $criteria->compare('NDEM',$this->NDEM);
        $criteria->compare('NOHEBERG',$this->NOHEBERG);
        $criteria->compare('DATERES',$this->DATERES,true);
        $criteria->compare('MONTANTRES',$this->MONTANTRES);
        $criteria->compare('DATANNUL',$this->DATANNUL,true);
        $criteria->compare('ETATRES',$this->ETATRES,true);
        $criteria->compare('ASSURANCE',$this->ASSURANCE);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
