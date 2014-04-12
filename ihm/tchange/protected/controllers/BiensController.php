<?php

class BiensController extends Controller
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
				'actions'=>array('catalogue', 'recherche'),
				'users'=>array('*'),
			),
			array('allow',
                'actions'=>array('proposer', 'index', 'modifier', 'ajouter'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    /**
     * Affiche tous les biens de l'utilisateur connecté
     */
    public function actionIndex()
    {
        $utilisateur = Utilisateurs::connecte();

        $criteria = new CDbCriteria();
        $criteria->addCondition('utilisateur='.$utilisateur->id);

        $count = Biens::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = (isset($_COOKIE['catalogue_biens_par_page'])) ? $_COOKIE['catalogue_biens_par_page'] : 3;
        $pages->applyLimit($criteria);

        $biens = Biens::model()->findAll($criteria);

        $this->render('index', array('biens' => $biens, 'pages' => $pages));
    }

    /**
	 * Affiche le catalogue des biens, avec filtre par catégorie
	 */
    public function actionCatalogue()
    {
        $criteria = new CDbCriteria();

        if (!Yii::app()->user->isGuest)
        {
            $utilisateur = Utilisateurs::connecte();
            $criteria->addCondition('utilisateur != '.$utilisateur->id);
        }
        if (isset($_GET['scat']))
            $criteria->addCondition('sous_categorie='.$_GET['scat']);
        elseif (isset($_GET['cat']))
        {
            $sous_categories = SousCategories::model()->findAll('categorie=:categorie', array('categorie' => $_GET['cat']));
            foreach ($sous_categories as $scat)
                $criteria->addCondition('sous_categorie='.$scat->id, 'OR');
        }
        else
            $fil = 'Tous les objets';

        $criteria->addCondition('disponible=1');
        $count = Biens::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize=(isset($_COOKIE['catalogue_biens_par_page'])) ? $_COOKIE['catalogue_biens_par_page'] : 3;
        $pages->applyLimit($criteria);

        $biens = Biens::model()->findAll($criteria);

        $this->render('catalogue', array(
            'biens' => $biens,
            'pages' => $pages,
            'fil' => $fil,
        ));
    }

    /**
	 * Recherche sur les biens
	 */
    public function actionRecherche()
    {
        $criteria = new CDbCriteria();
        // Moche et peu efficace
        $criteria->join = 'INNER JOIN (SELECT id as cat_id, nom as cat_nom FROM SousCategories) cat ON cat.cat_id = sous_categorie';

        // Critères de la recherche
        $criteres = preg_split('/[\s,]+/' ,$_GET['q'], -1, PREG_SPLIT_NO_EMPTY);
        $conditions = array();
        foreach ($criteres as $critere)
        {
            $criteria->addSearchCondition('nom', $critere, true, 'OR');
            $criteria->addSearchCondition('tags', $critere, true, 'OR');
            $criteria->addSearchCondition('cat_nom', $critere, true, 'OR');
        }

        // Critères communs (toujours après)
        $criteria->addCondition('disponible=1');
        if (!Yii::app()->user->isGuest)
        {
            $utilisateur = Utilisateurs::connecte();
            $criteria->addCondition('utilisateur != '.$utilisateur->id);
        }

        // Pagination
        $count = Biens::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize=(isset($_COOKIE['catalogue_biens_par_page'])) ? $_COOKIE['catalogue_biens_par_page'] : 3;
        $pages->applyLimit($criteria);

        // Récupère les biens
        $biens = Biens::model()->findAll($criteria);

        $this->render('catalogue', array(
            'biens' => $biens,
            'pages' => $pages,
            'fil' => 'Recherche',
        ));
    }

    /**
     * Ajoute un bien à la sélection
     * @ajax
     */
    public function actionAjouter()
    {
        // Test si la requête est valide
        if (!Yii::app()->request->isAjaxRequest || !isset($_GET['id']))
        {
            echo "Requête invalide";
            return;
        }

        // Test si le bien existe et n'appartient pas à l'utilisatuer
        $utilisateur = Utilisateurs::connecte();
        $bien = Biens::model()->find('id=:id AND utilisateur!=:utilisateur', array('id' => $_GET['id'], 'utilisateur' => $utilisateur->id));
        if (!$bien)
        {
            echo "Ce bien n'existe pas";
            return;
        }

        // Test si un échange n'est pas déjà en cours pour cette objet
        $deja_echange = Echanges::model()->find('troqueur=:troqueur AND objet_demande=:bien', array('troqueur' => $utilisateur->id, 'bien' => $bien->id));
        if ($deja_echange)
        {
            echo "Vous avez déjà un échange en cours pour cette objet";
            return;
        }

        $echange = new Echanges();
        $echange->troqueur = $utilisateur->id;
        $echange->troque = $bien->utilisateur;
        $echange->statut = Echanges::$SELECTION;
        $echange->objet_demande = $bien->id;
        $echange->save();
    }

    /**
	 * Enregistre le bien d'un utilisateur
	 */
	public function actionProposer()
	{
        $model = new Biens('proposer');

		if (isset($_POST['Biens']))
		{
            $utilisateur = Utilisateurs::connecte();
			if (!$utilisateur) return CHttpException(404);

            $model->attributes = $_POST['Biens'];
            $model->photo = CUploadedFile::getInstance($model,'photo');
            $model->utilisateur = $utilisateur->id;
			if($model->validate() && $model->save())
            {
                // Upload la photo
                $model->photo->saveAs(Biens::$path.$model->id   .'.jpg');
                Yii::app()->user->setFlash('bien', "Le bien a été ajouté avec succès !");

                $this->redirect('/biens/proposer');
            }
		}

		$this->render('proposer',array(
			'model'=>$model,
		));
	}

    /**
     * Permet à l'utilisateur connecté de modifier l'un de ses biens
     */
    public function actionModifier()
    {
        $model = Biens::model()->find('utilisateur=:utilisateur AND id=:id', array('utilisateur' => Utilisateurs::connecte()->id, 'id' => $_GET['id']));
        if (!$model)
            throw new CHttpException(404);
        $model->scenario = 'modifier';

        if (isset($_POST['Biens']))
		{
            $model->attributes = $_POST['Biens'];
            $photo = CUploadedFile::getInstance($model,'photo');
            if ($photo->name)
            {
                $model->photo = $photo;
                $model->photo->saveAs(Biens::$path.$model->id.'.jpg');
            }

			if($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('bien', "Le bien a été modifié avec succès !");
            }
		}

        $this->render('modifier', array('model' => $model));
    }
}
