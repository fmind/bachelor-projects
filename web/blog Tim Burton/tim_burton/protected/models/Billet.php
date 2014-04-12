<?php

/**
 * This is the model class for table "{{billet}}".
 *
 * The followings are the available columns in table '{{billet}}':
 * @property integer $id
 * @property string $titre
 * @property string $contenu
 * @property integer $create_time
 * @property integer $update_time
 *
 * The followings are the available model relations:
 * @property Commentaire[] $commentaires
 */
class Billet extends CActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @return Billet the static model class
   */
  public static function model($className=__CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{billet}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('titre, contenu', 'required'),
        array('titre', 'length', 'max' => 128),
        array('titre', 'unique'),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('titre', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
        'commentaires' => array(
            self::HAS_MANY,
            'Commentaire', 'billet_id',
            'order' => 'commentaires.create_time DESC'
        )
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'titre' => 'Titre',
        'contenu' => 'Contenu',
        'create_time' => 'Create Time',
        'update_time' => 'Update Time',
        'commentaires' => 'Commentaires'
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

    $criteria->compare('titre', $this->titre, true);

    return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
        'sort' => array(
            'defaultOrder' => 'create_time DESC',
        ),
    ));
  }

  /**
   * @return URL to a billet link
   */
  public function getUrl() {
    return Yii::app()->createUrl('billet/lire', array(
        'id' => $this->id,
        'titre' => $this->titre,
    ));
  }

  /**
   * Trigger to save create and update time
   */
  protected function beforeSave() {
    if (parent::beforeSave()) {
      if ($this->isNewRecord) {
        $this->create_time = $this->update_time = time();
      }
      else
        $this->update_time = time();
      return true;
    }
    else
      return false;
  }

  /**
   * Trigger to delete related comments
   */
  protected function afterDelete() {
    parent::afterDelete();
    Commentaire::model()->deleteAll('billet_id=' . $this->id);
  }

}