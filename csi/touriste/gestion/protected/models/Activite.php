<?php

class Activite extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Activite the static model class
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
        return 'Activite';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NOTYPACT, NOMACT, INTERIEUR, ENFANTACT', 'required'),
            array('NOTYPACT, INTERIEUR, ENFANTACT', 'numerical', 'integerOnly'=>true),
            array('NOMACT', 'length', 'max'=>30),
            array('ENFANTACT', 'boolean'),
            array('INTERIEUR', 'boolean'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NOACT, NOTYPACT, NOMACT, INTERIEUR, ENFANTACT', 'safe', 'on'=>'search'),
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
            'typeActRel' => array(self::BELONGS_TO, 'TypeActivite', 'NOTYPACT'),
            'stations' => array(self::MANY_MANY, 'Station', 'Possible(NOACT, NOSTAT)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'NOACT' => 'N°',
            'NOTYPACT' => 'Type',
            'NOMACT' => 'Nom',
            'INTERIEUR' => 'En Interieur',
            'ENFANTACT' => 'Avec enfants',
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

        $criteria->compare('NOACT',$this->NOACT);
        $criteria->compare('NOTYPACT',$this->NOTYPACT);
        $criteria->compare('NOMACT',$this->NOMACT,true);
        $criteria->compare('INTERIEUR',$this->INTERIEUR);
        $criteria->compare('ENFANTACT',$this->ENFANTACT);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
