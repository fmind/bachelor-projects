<?php

/**
 * CommentForm class.
 */
class CommentForm extends CFormModel {

  public $pseudo;
  public $email;
  public $url;
  public $contenu;
  public $billet_id;

  /**
   * Declares the validation rules.
   */
  public function rules() {
    return array(
        // name, email, subject and body are required
        array('pseudo, email, contenu', 'required'),
        // email has to be a valid email address
        array('email', 'email'),
        // url has to be a valid url address
        array('url', 'url'),
    );
  }

  /**
   * Declares customized attribute labels.
   * If not declared here, an attribute would have a label that is
   * the same as its name with the first letter in upper case.
   */
  public function attributeLabels() {
    return array(
        'pseudo' => 'Nom ou pseudo',
        'email' => 'Email',
        'url' => 'Votre site web',
        'contenu' => 'Votre commentaire'
    );
  }

}