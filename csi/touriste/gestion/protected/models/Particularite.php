<?php

class Particularite extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Particularite the static model class
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
        return 'Particularite';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NOMPART, ADRESSEPART, DESCRIPTIONPART, HANDI_ACCESSIBLE', 'required'),
            array('HANDI_ACCESSIBLE', 'numerical', 'integerOnly'=>true),
            array('NOMPART', 'length', 'max'=>30),
            array('ADRESSEPART', 'length', 'max'=>100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NOPART, NOMPART, ADRESSEPART, DESCRIPTIONPART, HANDI_ACCESSIBLE', 'safe', 'on'=>'search'),
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
            'stations' => array(self::MANY_MANY, 'Station', 'Voir(NOPART, NOSTAT)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'NOPART' => 'N°',
            'NOMPART' => 'Nom',
            'ADRESSEPART' => 'Adresse',
            'DESCRIPTIONPART' => 'Description',
            'HANDI_ACCESSIBLE' => 'Accessible aux handicapés',
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

        $criteria->compare('NOPART',$this->NOPART);
        $criteria->compare('NOMPART',$this->NOMPART,true);
        $criteria->compare('ADRESSEPART',$this->ADRESSEPART,true);
        $criteria->compare('DESCRIPTIONPART',$this->DESCRIPTIONPART,true);
        $criteria->compare('HANDI_ACCESSIBLE',$this->HANDI_ACCESSIBLE);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
