<?php

class BilletController extends Controller {

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
            'actions' => array('index', 'lire', 'comment'),
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

    $model = new Billet;

    if (isset($_POST['Billet'])) {
      $model->attributes = $_POST['Billet'];
      if ($model->save())
        $this->redirect(array('view', 'id' => $model->id));
    }

    $this->render('create', array(
        'model' => $model,
    ));
  }

  /**
   * View a model
   * @param integer $id the ID of the model to be viewed
   */
  public function actionView($id) {
    $this->layout = "//layouts/admin_column2";

    $model = $this->loadModel($id);

    $this->render('view', array(
        'model' => $model,
    ));
  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id) {
    $this->layout = "//layouts/admin_column2";

    $model = $this->loadModel($id);

    if (isset($_POST['Billet'])) {
      $model->attributes = $_POST['Billet'];
      if ($model->save())
        $this->redirect(array('view', 'id' => $model->id));
    }

    $this->render('update', array(
        'model' => $model,
    ));
  }

  /**
   * Delete a comment
   * @param integer $id the ID of the comment to be deleted
   */
  public function actionModerate($id) {
    $comment = Commentaire::model()->findByPk($id);
    if ($comment === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    $model = $this->loadModel($comment->billet_id);
    if ($comment === null)
      throw new CHttpException(404, 'The requested page does not exist.');

    $comment->delete();

    Yii::app()->end();
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
    $billet = new Billet();
    $billets = $billet->findAll(array('order' => 'create_time DESC'));

    $this->render('index', array(
        'billets' => $billets,
    ));
  }

  /**
   * Show a model
   * @param integer $id the ID of the model to be readed
   */
  public function actionLire($id) {
    $billet = $this->loadModel($id);
    $comment_form = new CommentForm;
    $comment_form->billet_id = $billet->id;

    $focus_comment = false;
    if (isset($_SESSION['comment']))
    {
      unset($_SESSION['comment']);
      $focus_comment = true;
    }
    
    $this->render('lire', array(
        'billet' => $billet,
        'comment_form' => $comment_form,
        'focus_comment' => $focus_comment
    ));
  }

  /**
   * Add a comment to a billet
   */
  public function actionComment() {
    if (isset($_POST['CommentForm'])) {
      $comment = new Commentaire;
      $comment->attributes = $_POST['CommentForm'];
      
      if ($comment->validate()) {
        if ($comment->save()) {
          $_SESSION['comment'] = true;
          $this->redirect(array('lire', 'id' => $_POST['CommentForm']['billet_id']));
        }
      }
    }
  }

  /**
   * Manages all models.
   */
  public function actionAdmin() {
    $this->layout = "//layouts/admin_column2";

    $model = new Billet('search');
    $model->unsetAttributes();  // clear any default values
    if (isset($_GET['Billet']))
      $model->attributes = $_GET['Billet'];

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
    $model = Billet::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, "Le billet demandé n'existe pas");
    return $model;
  }
}
