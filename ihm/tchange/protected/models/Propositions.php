<?php

/**
 * This is the model class for table "Propositions".
 *
 * The followings are the available columns in table 'Propositions':
 * @property integer $id
 * @property integer $bien
 * @property integer $objet
 * @property integer $echange
 *
 * The followings are the available model relations:
 * @property Biens $bienRel
 * @property Biens $objetRel
 * @property Echanges $echangeRel
 */
class Propositions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Propositions the static model class
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
		return 'Propositions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bien', 'required'),
			array('bien', 'numerical', 'integerOnly'=>true),
            array('objet', 'required'),
			array('objet', 'numerical', 'integerOnly'=>true),
            array('echange', 'required'),
			array('echange', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bien, objet, echange', 'safe', 'on'=>'search'),
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
			'bienRel' => array(self::BELONGS_TO, 'Biens', 'bien'),
            'objetRel' => array(self::BELONGS_TO, 'Biens', 'objet'),
            'echangeRel' => array(self::BELONGS_TO, 'Echanges', 'echange'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'bien' => 'Bien',
            'objet' => 'Objet',
            'echange' => 'Échanges',
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

		$criteria->compare('bien',$this->bien);
        $criteria->compare('objet',$this->objet);
        $criteria->compare('echange',$this->echange);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}