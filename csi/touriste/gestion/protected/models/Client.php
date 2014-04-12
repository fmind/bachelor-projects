<?php

class Client extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Client the static model class
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
        return 'Client';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NOM, PRENOM, DATENAISS, SEXE, SITMARITAL, TELEPHONECLIENT, EMAILCLIENT, ADRESSECLIENT', 'required'),
            array('NOM, PRENOM, SITMARITAL', 'length', 'max'=>30),
            array('DATENAISS', 'date', 'format'=>'yyyy-M-d'),
            array('SEXE', 'length', 'max'=>1),
            array('SEXE', 'in', 'range'=>array('F', 'H', 'I')),
            array('SITMARITAL', 'in', 'range'=>array('célibataire', 'marié', 'divorcé')),
            array('TELEPHONECLIENT', 'length', 'max'=>15, 'min' => '10'),
            array('EMAILCLIENT', 'length', 'max'=>50),
            array('ADRESSECLIENT', 'length', 'max'=>100),
            array('TELEPHONECLIENT', 'numerical', 'integerOnly' => true),
            array('EMAILCLIENT', 'email'),
            array('EMAILCLIENT', 'unique'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NOCLIENT, NOM, PRENOM, DATENAISS, SEXE, SITMARITAL, TELEPHONECLIENT, EMAILCLIENT, ADRESSECLIENT', 'safe', 'on'=>'search'),
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
            'demandes' => array(self::HAS_MANY, 'Demande', 'NOCLIENT'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'NOCLIENT' => 'N°',
            'NOM' => 'Nom',
            'PRENOM' => 'Prénom',
            'DATENAISS' => 'Date de naissance',
            'SEXE' => 'Sexe',
            'SITMARITAL' => 'Situation marital',
            'TELEPHONECLIENT' => 'Téléphone',
            'EMAILCLIENT' => 'Email',
            'ADRESSECLIENT' => 'Adresse',
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

        $criteria->compare('NOCLIENT',$this->NOCLIENT);
        $criteria->compare('NOM',$this->NOM,true);
        $criteria->compare('PRENOM',$this->PRENOM,true);
        $criteria->compare('DATENAISS',$this->DATENAISS,true);
        $criteria->compare('SEXE',$this->SEXE,true);
        $criteria->compare('SITMARITAL',$this->SITMARITAL,true);
        $criteria->compare('TELEPHONECLIENT',$this->TELEPHONECLIENT,true);
        $criteria->compare('EMAILCLIENT',$this->EMAILCLIENT,true);
        $criteria->compare('ADRESSECLIENT',$this->ADRESSECLIENT,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
