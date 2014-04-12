<?php

/**
 * This is the model class for table "Paiement".
 *
 * The followings are the available columns in table 'Paiement':
 * @property integer $NOPAIE
 * @property integer $NOTYPPAIE
 * @property string $LIBELLEPAIE
 * @property double $MONTANTPAIE
 * @property string $DATEPAIE
 * @property integer $REMBOURSEPAIE
 *
 * The followings are the available model relations:
 * @property TypePaiement $nOTYPPAIE
 */
class Paiement extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Paiement the static model class
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
        return 'Paiement';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NORES, NOTYPPAIE, LIBELLEPAIE, MONTANTPAIE, DATEPAIE, REMBOURSEPAIE', 'required'),
            array('NORES, NOTYPPAIE, REMBOURSEPAIE, MONTANTPAIE', 'numerical', 'integerOnly'=>true),
            array('LIBELLEPAIE', 'length', 'max'=>50),
            array('DATEPAIE', 'date', 'format'=>'yyyy-M-d'),
            array('REMBOURSEPAIE', 'boolean'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NORES, NOPAIE, NOTYPPAIE, LIBELLEPAIE, MONTANTPAIE, DATEPAIE, REMBOURSEPAIE', 'safe', 'on'=>'search'),
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
            'typePaiementRel' => array(self::BELONGS_TO, 'TypePaiement', 'NOTYPPAIE'),
            'reservationRel' => array(self::BELONGS_TO, 'Reservation', 'NORES'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'NOPAIE' => 'N°',
            'NORES' => 'N° Réservation',
            'NOTYPPAIE' => 'Type',
            'LIBELLEPAIE' => 'Libellé',
            'MONTANTPAIE' => 'Montant',
            'DATEPAIE' => 'Date',
            'REMBOURSEPAIE' => 'Remboursement',
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

        $criteria->compare('NOPAIE',$this->NOPAIE);
        $criteria->compare('NORES',$this->NORES);
        $criteria->compare('NOTYPPAIE',$this->NOTYPPAIE);
        $criteria->compare('LIBELLEPAIE',$this->LIBELLEPAIE,true);
        $criteria->compare('MONTANTPAIE',$this->MONTANTPAIE);
        $criteria->compare('DATEPAIE',$this->DATEPAIE,true);
        $criteria->compare('REMBOURSEPAIE',$this->REMBOURSEPAIE);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
