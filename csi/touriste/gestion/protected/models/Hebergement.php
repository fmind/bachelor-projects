<?php

class Hebergement extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Hebergement the static model class
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
        return 'Hebergement';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NOPREST, NOTYPH, ADRESSE, QUALITE, SURFACE, NBLITADULT, NBLITENFANT, WIFI, RESTAURATION, GESTIONAGENCE', 'required'),
            array('NOPREST, NOTYPH', 'numerical', 'integerOnly'=>true),
            array('SURFACE', 'numerical', 'min' => 5, 'max' => 300),
            array('ADRESSE', 'length', 'max'=>100),
            array('QUALITE', 'length', 'max'=>30),
            array('QUALITE', 'in', 'range'=>array('neuf', 'récent', 'ancien')),
            array('WIFI', 'boolean'),
            array('RESTAURATION', 'boolean'),
            array('GESTIONAGENCE', 'boolean'),
            array('NBLITADULT', 'numerical', 'min' => 1, 'max' => 10),
            array('NBLITENFANT', 'numerical', 'min' => 0, 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NOHEBERG, NOPREST, NOTYPH, ADRESSE, QUALITE, SURFACE, NBLITADULT, NBLITENFANT, WIFI, RESTAURATION, GESTIONAGENCE', 'safe', 'on'=>'search'),
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
            'saisons' => array(self::MANY_MANY, 'Saison', 'APour(NOHEBERG, NOSAISON)'),
            'disponibilites' => array(self::MANY_MANY, 'Disponibilite', 'Dispo(NOHEBERG, NODISP)'),
            'prestataireRel' => array(self::BELONGS_TO, 'Prestataire', 'NOPREST'),
            'typeHebergRel' => array(self::BELONGS_TO, 'TypeHeberg', 'NOTYPH'),
            'reservations' => array(self::HAS_MANY, 'Reservation', 'NOHEBERG'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'NOHEBERG' => 'N°',
            'NOPREST' => 'Prestataire',
            'NOTYPH' => 'Type',
            'ADRESSE' => 'Adresse',
            'QUALITE' => 'Qualité',
            'SURFACE' => 'Surface',
            'NBLITADULT' => 'Nombre de lit adulte',
            'NBLITENFANT' => 'Nombre de lit enfant',
            'WIFI' => 'Avec Wifi',
            'RESTAURATION' => 'Avec Restaurant',
            'GESTIONAGENCE' => 'Géré par l\'agence',
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

        $criteria->compare('NOHEBERG',$this->NOHEBERG);
        $criteria->compare('NOPREST',$this->NOPREST);
        $criteria->compare('NOTYPH',$this->NOTYPH);
        $criteria->compare('ADRESSE',$this->ADRESSE,true);
        $criteria->compare('QUALITE',$this->QUALITE,true);
        $criteria->compare('SURFACE',$this->SURFACE);
        $criteria->compare('NBLITADULT',$this->NBLITADULT);
        $criteria->compare('NBLITENFANT',$this->NBLITENFANT);
        $criteria->compare('WIFI',$this->WIFI);
        $criteria->compare('RESTAURATION',$this->RESTAURATION);
        $criteria->compare('GESTIONAGENCE',$this->GESTIONAGENCE);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
