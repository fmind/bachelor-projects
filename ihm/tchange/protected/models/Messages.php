<?php

/**
 * This is the model class for table "Messages".
 *
 * The followings are the available columns in table 'Messages':
 * @property integer $id
 * @property integer $source
 * @property integer $destinataire
 * @property integer $bien
 * @property string $message
 * @property integer $lu
 * @property string $date_envoie
 * @property string $date_lecture
 *
 * The followings are the available model relations:
 * @property Utilisateurs $destinataireRel
 * @property Utilisateurs $sourceRel
 * @property Biens $bienRel
 */
class Messages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Messages the static model class
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
		return 'Messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('source, destinataire, bien, message', 'required'),
			array('source, destinataire, bien, lu', 'numerical', 'integerOnly'=>true),
			array('date_lecture', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('source, destinataire, bien, lu, date_envoie, date_lecture', 'safe', 'on'=>'search'),
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
			'destinataireRel' => array(self::BELONGS_TO, 'Utilisateurs', 'destinataire'),
			'sourceRel' => array(self::BELONGS_TO, 'Utilisateurs', 'source'),
            'bienRel' => array(self::BELONGS_TO, 'Biens', 'bien'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'source' => 'Source',
			'destinataire' => 'Destinataire',
            'bien' => 'Bien',
			'message' => 'Message',
			'lu' => 'Lu',
			'date_envoie' => 'Date d\'Envoie',
			'date_lecture' => 'Date de Lecture',
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

		$criteria->compare('source',$this->source);
		$criteria->compare('destinataire',$this->destinataire);
        $criteria->compare('bien',$this->bien);
		$criteria->compare('lu',$this->lu);
		$criteria->compare('date_envoie',$this->date_envoie);
		$criteria->compare('date_lecture',$this->date_lecture);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'date_envoie DESC',
            ),
		));
	}

    /**
     * Triggered on create and update
     */
    protected function beforeSave()
    {
        if ($this->isNewRecord)
            $this->date_envoie = date('Y-m-d H:i:s');

        return parent::beforeSave();
    }
}