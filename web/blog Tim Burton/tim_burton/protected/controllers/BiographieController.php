<?php

class BiographieController extends Controller {

  public $layout = "//layouts/main";

  /**
   * @return array action filters
   */
  public function filters() {
    return array(
        'accessControl', // perform access control for CRUD operations
    );
  }

  /**
   * Specifies the access control rules.
   * This method is used by the 'accessControl' filter.
   * @return array access control rules
   */
  public function accessRules() {
    return array(
        array('allow', // allow all users to perform 'list' and 'show' actions
            'actions' => array('index'),
            'users' => array('*'),
        ),
        array('allow', // allow authenticated users to perform any action
            'users' => array('@'),
        ),
        array('deny', // deny all users
            'users' => array('*'),
        ),
    );
  }

  /**
   * Lists all models.
   */
  public function actionIndex() {
    $bio = $this->loadModel();

    $this->render('index', array(
        'bio' => $bio,
    ));
  }

  /**
   * Manages the model
   */
  public function actionAdmin() {
    $this->layout = "//layouts/admin_column1";
    $bio = $this->loadModel();

    if (isset($_POST['Biographie'])) {
      $bio->attributes = $_POST['Biographie'];
      if ($bio->validate())
        $bio->save();
    }
    
    $this->render('admin', array(
        'bio' => $bio,
    ));
  }

  /**
   * Return the only model (more simple this way)
   */
  public function loadModel() {
    $model = Biographie::model()->findByPk(1);
    if ($model === null)
      throw new CHttpException(404, "Le billet demandé n'existe pas");
    return $model;
  }
}
