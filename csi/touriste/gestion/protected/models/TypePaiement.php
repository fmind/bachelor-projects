<?php

class TypePaiement extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TypePaiement the static model class
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
        return 'TypePaiement';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('LIBELLETYPPAIE', 'required'),
            array('LIBELLETYPPAIE', 'length', 'max'=>30),
            array('LIBELLETYPPAIE', 'unique'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NOTYPPAIE, LIBELLETYPPAIE', 'safe', 'on'=>'search'),
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
            'paiements' => array(self::HAS_MANY, 'Paiement', 'NOTYPPAIE'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'NOTYPPAIE' => 'N°',
            'LIBELLETYPPAIE' => 'Libellé',
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

        $criteria->compare('NOTYPPAIE',$this->NOTYPPAIE);
        $criteria->compare('LIBELLETYPPAIE',$this->LIBELLETYPPAIE,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
