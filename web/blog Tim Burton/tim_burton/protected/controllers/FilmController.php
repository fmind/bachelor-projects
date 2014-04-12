<?php

class FilmController extends Controller {

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
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate() {
    $this->layout = "//layouts/admin_column2";
    
    $model = new Film;

    if (isset($_POST['Film'])) {
      $model->attributes = $_POST['Film'];
      $model->image=CUploadedFile::getInstance($model,'image');
      if ($model->save()) {
        $model->image->saveAs('images/films/'.$model->id.'.jpg');
        $this->redirect(array('update', 'id' => $model->id));
      }
    }

    $this->render('create', array(
        'model' => $model,
    ));
  }

  /**
   * Redirect to the update action
   * @param integer $id the ID of the model to be viewed
   */
  public function actionView($id) {
    $this->redirect(array('update', 'id' => $id));
  }
  
  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id) {
    $this->layout = "//layouts/admin_column2";
    
    $model = $this->loadModel($id);

    if (isset($_POST['Film'])) {
      $model->attributes = $_POST['Film'];
      $model->image=CUploadedFile::getInstance($model,'image');
      if ($model->save()) {
        $model->image->saveAs('images/films/'.$model->id.'.jpg');
        $this->redirect(array('update', 'id' => $model->id));
      }
    }

    $this->render('update', array(
        'model' => $model,
    ));
  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'admin' page.
   * @param integer $id the ID of the model to be deleted
   */
  public function actionDelete($id) {
    if (Yii::app()->request->isPostRequest) {
      // we only allow deletion via POST request
      $this->loadModel($id)->delete();

      // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
      if (!isset($_GET['ajax']))
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    else
      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
  }

  /**
   * Lists all models.
   */
  public function actionIndex() {
    $film = new Film();

    $this->render('index', array(
        'films' => $film->findAll(array('order' => 'date_sortie DESC')),
    ));
  }

  /**
   * Manages all models.
   */
  public function actionAdmin() {
    $this->layout = "//layouts/admin_column2";
    
    $model = new Film('search');
    $model->unsetAttributes();  // clear any default values
    if (isset($_GET['Film']))
      $model->attributes = $_GET['Film'];

    $this->render('admin', array(
        'model' => $model,
    ));
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadModel($id) {
    $model = Film::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

}
