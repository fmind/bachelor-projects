<?php

/**
 * This is the model class for table "{{commentaire}}".
 *
 * The followings are the available columns in table '{{commentaire}}':
 * @property integer $id
 * @property string $contenu
 * @property string $pseudo
 * @property string $email
 * @property string $url
 * @property integer $create_time
 * @property integer $billet_id
 *
 * The followings are the available model relations:
 * @property Billet $billet
 */
class Commentaire extends CActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @return Commentaire the static model class
   */
  public static function model($className=__CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return '{{commentaire}}';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('contenu, pseudo, email, billet_id', 'required'),
        array('create_time, billet_id', 'numerical', 'integerOnly' => true),
        array('pseudo, email, url', 'length', 'max' => 128),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id, contenu, pseudo, email, url, create_time, billet_id', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
        'billet' => array(self::BELONGS_TO, 'Billet', 'billet_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id' => 'ID',
        'contenu' => 'Contenu',
        'pseudo' => 'Pseudo',
        'email' => 'Email',
        'url' => 'Url',
        'create_time' => 'Create Time',
        'billet_id' => 'Billet',
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
    $criteria->compare('contenu', $this->contenu, true);
    $criteria->compare('pseudo', $this->pseudo, true);
    $criteria->compare('email', $this->email, true);
    $criteria->compare('url', $this->url, true);
    $criteria->compare('create_time', $this->create_time);
    $criteria->compare('billet_id', $this->billet_id);

    return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
    ));
  }

  /**
   * Trigger to save create and update time
   */
  protected function beforeSave() {
    if (parent::beforeSave()) {
      $this->create_time = time();
      return true;
    }
  }

}