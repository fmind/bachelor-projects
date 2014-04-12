<?php

class SousCategoriesController extends Controller
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
				'users'=>array('mederic', 'florent', 'quentin'),
                'actions'=>array('create', 'update', 'delete', 'admin')
			),
            array('allow',
                'users'=>array('@'),
                'actions'=>array('parCategorie'),
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    /**
     * Renvoie toutes les sous-catégories d'une catégorie
     * @ajax
     */
    public function actionParCategorie()
    {
        if (Yii::app()->getRequest()->isAjaxRequest && isset($_GET['categorie']))
        {
            $categorie = $_GET['categorie'];
            $sous_categories = SousCategories::model()->findAll('categorie=:categorie', array(':categorie'=>$categorie));
            echo CJSON::encode($sous_categories);
        }
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $this->layout = "//layouts/admin";

		$model=new SousCategories;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SousCategories']))
		{
			$model->attributes=$_POST['SousCategories'];
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

		if(isset($_POST['SousCategories']))
		{
			$model->attributes=$_POST['SousCategories'];
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

		$model=new SousCategories('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SousCategories']))
			$model->attributes=$_GET['SousCategories'];

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
		$model=SousCategories::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,"La sous-catégorie n'existe pas");
		return $model;
	}
}
