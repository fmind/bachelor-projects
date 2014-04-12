<?php

class Prestataire extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Prestataire the static model class
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
        return 'Prestataire';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NOSTAT, NOTYPP, NOMPREST, TELEPHONEPREST, EMAILPREST', 'required'),
            array('NOSTAT, NOTYPP', 'numerical', 'integerOnly'=>true),
            array('NOMPREST', 'length', 'max'=>30),
            array('TELEPHONEPREST', 'numerical', 'integerOnly' => true),
            array('TELEPHONEPREST', 'length', 'max' => 15, 'min' => 10),
            array('EMAILPREST', 'length', 'max'=>50),
            array('EMAILPREST', 'email'),
            array('EMAILPREST', 'unique'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NOPREST, NOSTAT, NOTYPP, NOMPREST, TELEPHONEPREST, EMAILPREST', 'safe', 'on'=>'search'),
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
            'stationRel' => array(self::BELONGS_TO, 'Station', 'NOSTAT'),
            'typePrestRel' => array(self::BELONGS_TO, 'TypePrest', 'NOTYPP'),
            'hebergements' => array(self::HAS_MANY, 'Hebergement', 'NOPREST'),
            'services' => array(self::MANY_MANY, 'Service', 'Offert(NOPREST, NOSERV)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'NOPREST' => 'N°',
            'NOSTAT' => 'Station',
            'NOTYPP' => 'Type',
            'NOMPREST' => 'Nom',
            'TELEPHONEPREST' => 'Téléphone',
            'EMAILPREST' => 'Email',
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

        $criteria->compare('NOPREST',$this->NOPREST);
        $criteria->compare('NOSTAT',$this->NOSTAT);
        $criteria->compare('NOTYPP',$this->NOTYPP);
        $criteria->compare('NOMPREST',$this->NOMPREST,true);
        $criteria->compare('TELEPHONEPREST',$this->TELEPHONEPREST,true);
        $criteria->compare('EMAILPREST',$this->EMAILPREST,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
