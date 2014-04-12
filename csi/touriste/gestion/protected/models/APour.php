<?php

class APour extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return APour the static model class
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
        return 'APour';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NOSAISON, NOHEBERG, PRIX', 'required'),
            array('NOSAISON, NOHEBERG', 'numerical', 'integerOnly'=>true),
            array('PRIX', 'numerical'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NOSAISON, NOHEBERG, PRIX', 'safe', 'on'=>'search'),
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
            'hebergementRel' => array(self::BELONGS_TO, 'Hebergement', 'NOHEBERG'),
            'saisonRel' => array(self::BELONGS_TO, 'Saison', 'NOSAISON'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'NOSAISON' => 'Saison',
            'NOHEBERG' => 'Hébergement',
            'PRIX' => 'Prix',
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
        $criteria->compare('NOHEBERG',$this->NOHEBERG);
        $criteria->compare('PRIX',$this->PRIX);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
