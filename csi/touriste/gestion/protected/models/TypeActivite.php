<?php

class TypeActivite extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TypeActivite the static model class
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
        return 'TypeActivite';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NOMTYPACT', 'required'),
            array('NOMTYPACT', 'length', 'max'=>30),
            array('NOMTYPACT', 'unique'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NOTYPACT, NOMTYPACT', 'safe', 'on'=>'search'),
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
            'activites' => array(self::HAS_MANY, 'Activite', 'NOTYPACT'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'NOTYPACT' => 'N°',
            'NOMTYPACT' => 'Nom',
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

        $criteria->compare('NOTYPACT',$this->NOTYPACT);
        $criteria->compare('NOMTYPACT',$this->NOMTYPACT,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
