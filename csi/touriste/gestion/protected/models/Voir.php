<?php

class Voir extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Voir the static model class
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
        return 'Voir';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NOPART, NOSTAT', 'required'),
            array('NOPART, NOSTAT', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NOPART, NOSTAT', 'safe', 'on'=>'search'),
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
            'particulariteRel' => array(self::BELONGS_TO, 'PARTICULARITE', 'NOPART'),
            'stationRel' => array(self::BELONGS_TO, 'Saison', 'NOSAISON'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'NOPART' => 'N° Particularité',
            'NOSTAT' => 'N° Station',
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
        $criteria->compare('NOSTAT',$this->NOSTAT);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
