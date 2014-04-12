<?php

class InterrogationController extends Controller
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
     * Affiche le champ de requête SQL et les requêtes enregistrées
     */
    public function actionIndex()
    {
        $model = new Interrogation;

        $this->render('index', array(
            'model' => $model,
            'data' => null,
        ));
    }

    /**
     * Affiche le champ de requête SQL et les requêtes enregistrées
     * avec une requête déjà sélectionnée
     */
    public function actionView()
    {
        $model = $this->loadModel();

        $data = new CSqlDataProvider($model->sqlreq);
        try {
            $data->setTotalItemCount(count($data->getData()));
        } catch (Exception $e) {}

        $this->render('index', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    /**
     * Lance l'exécution d'une requête postée par formulaire
     * la sauvegarde si l'utilisateur a donné un nom unique
     */
    public function actionExec()
    {
        if(!isset($_POST['Interrogation']))
            $this->redirect(array('index'));

        $model = new Interrogation;
        $model->attributes = $_POST['Interrogation'];
        if (isset($_POST['save']) && $model->validate())
            $model->save();

        $data = new CSqlDataProvider($model->sqlreq);
        try {
            $data->setTotalItemCount(count($data->getData()));
        } catch (Exception $e) {}

        $this->render('index', array(
            'model' => $model,
            'data' => $data,
        ));
    }

    /**
     * Supprime une requête enregistrée
     */
    public function actionSupprimer()
    {
        $model = $this->loadModel();
        $model->delete();
        $this->redirect(array('index'));
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
                $this->_model=Interrogation::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
}
