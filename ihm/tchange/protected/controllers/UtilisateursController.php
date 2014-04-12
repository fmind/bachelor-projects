<?php

class UtilisateursController extends Controller
{
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
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            array('allow',
                'users'=>array('*'),
                'actions'=>array('inscription', 'captcha'),
            ),
            array('allow',
                'users'=>array('@'),
                'actions'=>array('profil'),
            ),
			array('allow',
				'users'=>array('mederic', 'florent', 'quentin'),
                'actions'=>array('create', 'update', 'delete', 'admin')
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    /**
     * Permet à l'utilisateur de son profil de changer son profil
     */
    public function actionProfil()
    {
        $model = new InscriptionForm('profil');
        $utilisateur = Utilisateurs::connecte();

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'utilisateurs-inscription-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['InscriptionForm']))
		{
            $model->attributes = $_POST['InscriptionForm'];
			$utilisateur->attributes = $_POST['InscriptionForm'];
			if($model->validate() && $utilisateur->save())
            {
                Yii::app()->user->id = $utilisateur->login;
                Yii::app()->user->name = $utilisateur->login;
                Yii::app()->user->setFlash('profil', "Votre profil a été modifié avec succès !");
                $this->redirect('profil');
            }
		}
        else
        {
            $model->attributes = $utilisateur->attributes;
            $model->mot_de_passe_confirmation = $model->mot_de_passe;
        }

        $this->render('profil', array('model' => $model));
    }

    /**
	 * Retourne le formulaire d'inscription
	 */
	public function actionInscription()
	{
		$model = new InscriptionForm('inscription');

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'utilisateurs-inscription-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // Peut on faire plus laid ...
		if(isset($_POST['InscriptionForm']))
		{
            $utilisateur = new Utilisateurs();
			$utilisateur->attributes=$_POST['InscriptionForm'];
			if($utilisateur->validate() && $utilisateur->save()) {
                $identity = new UserIdentity($utilisateur->login,$utilisateur->mot_de_passe);
                Yii::app()->user->login($identity,3600*24*30);
            }
            $this->redirect('/');
		}
	}

    /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $this->layout = "//layouts/admin";

		$model=new Utilisateurs;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Utilisateurs']))
		{
			$model->attributes=$_POST['Utilisateurs'];
			if($model->save())
				$this->redirect('admin');
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        $this->layout = "//layouts/admin";

		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Utilisateurs']))
		{
			$model->attributes=$_POST['Utilisateurs'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,"Requête invalide");
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
        $this->layout = "//layouts/admin";

		$model=new Utilisateurs('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Utilisateurs']))
			$model->attributes=$_GET['Utilisateurs'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Utilisateurs::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,"L'utilisateur n'existe pas");
		return $model;
	}
}
