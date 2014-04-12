<?php

class Station extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Station the static model class
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
        return 'Station';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NOMSTAT, ADRESSESTAT, TELEPHONESTAT, EMAILSTAT', 'required'),
            array('NOMSTAT', 'length', 'max'=>30),
            array('ADRESSESTAT', 'length', 'max'=>100),
            array('TELEPHONESTAT', 'length', 'max'=>15),
            array('TELEPHONESTAT', 'numerical', 'integerOnly'=>true, 'min' => 10),
            array('EMAILSTAT', 'length', 'max'=>50),
            array('EMAILSTAT', 'email'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NOSTAT, NOMSTAT, ADRESSESTAT, TELEPHONESTAT, EMAILSTAT', 'safe', 'on'=>'search'),
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
            'prestataireRel' => array(self::BELONGS_TO, 'Prestataire', 'NOPREST'),
            'demandes' => array(self::HAS_MANY, 'Demande', 'NOSTAT'),
            'activites' => array(self::MANY_MANY, 'Activite', 'Possible(NOSTAT, NOACT)'),
            'particularites' => array(self::MANY_MANY, 'Particularite', 'Voir(NOSTAT, NOPART)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'NOSTAT' => 'N°',
            'NOMSTAT' => 'Nom',
            'ADRESSESTAT' => 'Adresse',
            'TELEPHONESTAT' => 'Télephone',
            'EMAILSTAT' => 'Email',
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

        $criteria->compare('NOSTAT',$this->NOSTAT);
        $criteria->compare('NOMSTAT',$this->NOMSTAT,true);
        $criteria->compare('ADRESSESTAT',$this->ADRESSESTAT,true);
        $criteria->compare('TELEPHONESTAT',$this->TELEPHONESTAT,true);
        $criteria->compare('EMAILSTAT',$this->EMAILSTAT,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
