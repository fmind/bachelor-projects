<?php

class SiteController extends Controller {

  public $layout = "//layouts/main";

  /**
   * Declares class-based actions.
   */
  public function actions() {
    return array(
        // captcha action renders the CAPTCHA image displayed on the contact page
        'captcha' => array(
            'class' => 'CCaptchaAction',
            'backColor' => 0xFFFFFF,
        ),
        // page action renders "static" pages stored under 'protected/views/site/pages'
        // They can be accessed via: index.php?r=site/page&view=FileName
        'page' => array(
            'class' => 'CViewAction',
        ),
    );
  }

  /**
   * This is the default 'index' action that is invoked
   * when an action is not explicitly requested by users.
   */
  public function actionIndex() {
    $this->render('index');
  }

  /**
   * Welcome to admin interface
   */
  public function actionAdmin() {
    $this->layout = "//layouts/admin_column1";

    if (!Yii::app()->user->isGuest)
      $this->render('admin');
    else
      $this->redirect(array('login'));
  }

  /**
   * This is the action to handle external exceptions.
   */
  public function actionError() {
    $this->layout = "//layouts/admin_column1";

    if ($error = Yii::app()->errorHandler->error) {
      if (Yii::app()->request->isAjaxRequest)
        echo $error['message'];
      else
        $this->render('error', $error);
    }
  }

  /**
   * Displays the contact page
   */
  public function actionContact() {
    $model = new ContactForm;
    if (isset($_POST['ContactForm'])) {
      $model->attributes = $_POST['ContactForm'];
      if ($model->validate()) {
        $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
        //mail(Yii::app()->params['adminEmail'],"Requête de ".$model->name,$model->body,$headers);
        Yii::app()->user->setFlash('contact', "Merci pour votre message, nous y répondrons dès que possible !");
        $this->refresh();
      }
    }
    $this->render('contact', array('model' => $model));
  }

  /**
   * Displays the login page
   */
  public function actionLogin() {
    $this->layout = "//layouts/admin_column1";

    $model = new LoginForm;

    // if it is ajax validation request
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }

    // collect user input data
    if (isset($_POST['LoginForm'])) {
      $model->attributes = $_POST['LoginForm'];
      // validate user input and redirect to the previous page if valid
      if ($model->validate() && $model->login())
        $this->redirect(array('site/admin'));
    }
    // display the login form
    $this->render('login', array('model' => $model));
  }

  /**
   * Logs out the current user and redirect to homepage.
   */
  public function actionLogout() {
    Yii::app()->user->logout();
    $this->redirect(array('login'));
  }

}