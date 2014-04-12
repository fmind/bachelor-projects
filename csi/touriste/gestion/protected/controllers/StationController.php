<?php

class StationController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column1';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Station;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Station']))
        {
            $model->attributes=$_POST['Station'];
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate()
    {
        $model=$this->loadModel();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Station']))
        {
            $model->attributes=$_POST['Station'];
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Modification des activités de la station
     */
    public function actionActivites()
    {
        $model=$this->loadModel();

        if (isset($_POST['changed']))
        {
            Possible::model()->deleteAll('NOSTAT=:nostat', array('nostat' => $_GET['id']));

            if (isset($_POST['Activites']))
            {
                foreach ($_POST['Activites'] as $noact)
                {
                    $possible = new Possible();
                    $possible->NOSTAT = $model->NOSTAT;
                    $possible->NOACT = $noact;
                    $possible->save();
                }
            }

            $this->redirect(array('index'));
        }

        $this->render('activites',array(
            'model'=>$model,
        ));
    }

    /**
     * Modification des particularités de la station
     */
    public function actionParticularites()
    {
        $model=$this->loadModel();

        if (isset($_POST['changed']))
        {
            Voir::model()->deleteAll('NOSTAT=:nostat', array('nostat' => $_GET['id']));

            if (isset($_POST['Particularites']))
            {
                foreach ($_POST['Particularites'] as $nopart)
                {
                    $voir = new Voir();
                    $voir->NOSTAT = $model->NOSTAT;
                    $voir->NOPART = $nopart;
                    $voir->save();
                }
            }

            $this->redirect(array('index'));
        }

        $this->render('particularites',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete()
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel()->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(array('index'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $this->actionAdmin();
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Station('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Station']))
            $model->attributes=$_GET['Station'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel()
    {
        if($this->_model===null)
        {
            if(isset($_GET['id']))
                $this->_model=Station::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
}
