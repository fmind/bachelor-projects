<?php

class Saison extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Saison the static model class
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
        return 'Saison';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('DATEDEBS, DATEFINS', 'required'),
            array('DATEDEBS', 'date', 'format'=>'yyyy-M-d'),
            array('DATEFINS', 'date', 'format'=>'yyyy-M-d'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NOSAISON, DATEDEBS, DATEFINS', 'safe', 'on'=>'search'),
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
            'hebergements' => array(self::MANY_MANY, 'Hebergement', 'APour(NOSAISON, NOHEBERG)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'NOSAISON' => 'N°',
            'DATEDEBS' => 'Début',
            'DATEFINS' => 'Fin',
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

        $criteria->compare('NOSAISON',$this->NOSAISON);
        $criteria->compare('DATEDEBS',$this->DATEDEBS,true);
        $criteria->compare('DATEFINS',$this->DATEFINS,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
