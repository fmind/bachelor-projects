<?php

class Service extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Service the static model class
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
        return 'Service';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NOMSERVICE, COMPRIS', 'required'),
            array('COMPRIS', 'boolean'),
            array('NOMSERVICE', 'length', 'max'=>30),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NOSERV, NOMSERVICE, COMPRIS', 'safe', 'on'=>'search'),
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
            'prestataires' => array(self::MANY_MANY, 'Prestataire', 'Offert(NOSERV, NOPREST)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'NOSERV' => 'N°',
            'NOMSERVICE' => 'Nom',
            'COMPRIS' => 'Compris dans le prix',
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

        $criteria->compare('NOSERV',$this->NOSERV);
        $criteria->compare('NOMSERVICE',$this->NOMSERVICE,true);
        $criteria->compare('COMPRIS',$this->COMPRIS);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
