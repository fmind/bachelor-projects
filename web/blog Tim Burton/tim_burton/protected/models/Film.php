<?php

/**
 * This is the model class for table "{{film}}".
 *
 * The followings are the available columns in table '{{film}}':
 * @property integer $id
 * @property string $titre
 * @property string $date_sortie
 * @property string $genres
 * @property string $acteurs_principaux
 * @property string $synopsis
 * @property image $image
 */
class Film extends CActiveRecord {

  public $image;
  
  /**
   * Returns the static model of the specified AR class.
   * @return Film the static model class
   */
  public static function model($className=__CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{film}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('titre, date_sortie, synopsis', 'required'),
        array('titre', 'length', 'max' => 128),
        array('genres, acteurs_principaux', 'length', 'max' => 500),
        array('image', 'file', 'types'=>'jpg, gif, png'),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('titre, date_sortie', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'titre' => 'Titre',
        'date_sortie' => 'Date de sortie',
        'genres' => 'Genres',
        'acteurs_principaux' => 'Acteurs Principaux',
        'synopsis' => 'Synopsis',
        'image' => 'Affiche du film'
    );
  }

  /**
   * Retrieves a list of models based on the current search/filter conditions.
   * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
   */
  public function search() {
    // Warning: Please modify the following code to remove attributes that
    // should not be searched.

    $criteria = new CDbCriteria;

    $criteria->compare('id', $this->id);
    $criteria->compare('titre', $this->titre, true);
    $criteria->compare('date_sortie', $this->date_sortie, true);

    return new CActiveDataProvider($this, array(
        'criteria' => $criteria,'sort' => array(
            'defaultOrder' => 'date_sortie DESC',
        ),
    ));
  }

  /**
   * Change the date format for the database
   */
  protected function beforeSave() {
    $this->date_sortie = date('Y-m-d', CDateTimeParser::parse($this->date_sortie,'dd/MM/yyyy'));
    
    return true;
  }

  /**
   * Change the date format for the user
   */
  protected function afterFind() {
    $this->date_sortie = Yii::app()->dateFormatter->format('dd/MM/yyyy', CDateTimeParser::parse($this->date_sortie,'yyyy-MM-dd'));
  }
}