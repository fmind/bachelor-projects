<?php

class HebergementController extends Controller
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Hebergement;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Hebergement']))
        {
            $model->attributes=$_POST['Hebergement'];
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

        if(isset($_POST['Hebergement']))
        {
            $model->attributes=$_POST['Hebergement'];
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Modification des disponibilités de l'hébergement
     */
    public function actionDisponibilites()
    {
        $model=$this->loadModel();

        if (isset($_POST['changed']))
        {
            Dispo::model()->deleteAll('NOHEBERG=:noheberg', array('noheberg' => $_GET['id']));

            if (isset($_POST['Disponibilites']))
            {
                foreach ($_POST['Disponibilites'] as $nodispo)
                {
                    $dispo = new Dispo();
                    $dispo->NOHEBERG = $model->NOHEBERG;
                    $dispo->NODISP = $nodispo;
                    $dispo->save();
                }
            }

            $this->redirect(array('index'));
        }

        $this->render('disponibilites',array(
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
        $model=new Hebergement('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Hebergement']))
            $model->attributes=$_GET['Hebergement'];

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
                $this->_model=Hebergement::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
}
