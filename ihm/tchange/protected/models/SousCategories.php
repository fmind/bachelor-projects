<?php

/**
 * This is the model class for table "SousCategories".
 *
 * The followings are the available columns in table 'SousCategories':
 * @property integer $id
 * @property string $nom
 * @property integer $categorie
 *
 * The followings are the available model relations:
 * @property Champs[] $champs
 * @property Categories $categorieRel
 */
class SousCategories extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SousCategories the static model class
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
		return 'SousCategories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nom, categorie', 'required'),
			array('categorie', 'numerical', 'integerOnly'=>true),
			array('nom', 'length', 'max'=>50),
            array('nom', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('nom, categorie', 'safe', 'on'=>'search'),
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
			'champs' => array(self::HAS_MANY, 'Champs', 'champs', 'order' => 'Champs.nom'),
			'categorieRel' => array(self::BELONGS_TO, 'Categories', 'categorie'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nom' => 'Nom',
			'categorie' => 'Catégorie',
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

		$criteria->compare('nom',$this->nom,true);
		$criteria->compare('categorie',$this->categorie);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'nom',
            ),
		));
	}
}