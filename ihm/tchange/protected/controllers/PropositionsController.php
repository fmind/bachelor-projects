<?php

class PropositionsController extends Controller
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow',
                'actions'=>array('echange', 'ajouter', 'supprimer', 'choisir'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


    /**
     * Formulaire de proposition pour un échange
     * @note uniquement depuis statut SELECTION
     */
    public function actionEchange()
    {
        $utilisateur = Utilisateurs::connecte();

        $echange = Echanges::model()->find('id=:id AND troque=:utilisateur AND statut IN ('.Echanges::$SELECTION.', '.Echanges::$PROPOSITION.')', array(
            'id' => $_GET['id'], 'utilisateur' => $utilisateur->id
        ));

        if (!$echange)
        {
            echo 'Aucun échange trouvé';
            exit();
        }

        $biens = Biens::model()->findAll('utilisateur=:utilisateur AND disponible=1', array('utilisateur' => $echange->troqueur));

        $propositions = Propositions::model()->findAll('echange=:echange', array('echange'=>$echange->id));
        $propositions_biens = array();
        foreach ($propositions as $proposition)
            $propositions_biens[] = $proposition->bien;

        echo $this->renderPartial('_proposer', array(
            'biens' => $biens,
            'propositions' => $propositions,
            'propositions_biens' => $propositions_biens,
            'echange' => $echange,
        ));
    }

    /**
     * Ajoute une proposition
     */
    public function actionAjouter()
    {
        $utilisateur = Utilisateurs::connecte();
        $echange = Echanges::model()->find('id=:id AND troque=:utilisateur AND statut IN ('.Echanges::$SELECTION.', '.Echanges::$PROPOSITION.')', array(
            'id' => $_POST['echange'], 'utilisateur' => $utilisateur->id
        ));
        $bien = Biens::model()->find('id=:id AND utilisateur=:utilisateur AND disponible=1', array(
            'id' => $_POST['bien'], 'utilisateur' => $echange->troqueur
        ));

        if (!$echange || !$bien)
        {
            echo "Aucun échange possible pour cet objet";
            exit();
        }

        $proposition = new Propositions();
        $proposition->bien = $bien->id;
        $proposition->objet = $echange->objet_demande;
        $proposition->echange = $echange->id;
        $proposition->save();

        if ($echange->statut == Echanges::$SELECTION)
        {
            $echange->statut = Echanges::$PROPOSITION;
            $echange->save();
        }
    }

    /**
     * Supprime une proposition
     */
    public function actionSupprimer()
    {
        $proposition = Propositions::model()->find('echange=:echange AND bien=:bien', array(
           'echange' => $_POST['echange'], 'bien' => $_POST['bien']
        ));

        if (!$proposition)
        {
            echo "Impossible de retrouver cette proposition";
            exit();
        }

        $proposition->delete();

        // Récupère le nombre de proposition restante
        $nb_propositions = Propositions::model()->count('echange=:echange', array(
           'echange' => $_POST['echange']
        ));

        // On repasse l'échange à SELECTION si il n'en reste plus
        if (!$nb_propositions)
        {
            $utilisateur = Utilisateurs::connecte();
            $echange = Echanges::model()->find('id=:id AND troque=:utilisateur AND statut  = '.Echanges::$PROPOSITION, array(
                'id' => $_POST['echange'], 'utilisateur' => $utilisateur->id
            ));

            if ($echange)
            {
                $echange->statut = Echanges::$SELECTION;
                $echange->save();
            }
        }
    }


    /**
     * Formulaire de choix pour un échange
     * @note uniquement depuis statut PROPOSITION
     */
    public function actionChoisir()
    {
        $utilisateur = Utilisateurs::connecte();

        $echange = Echanges::model()->find('id=:id AND troqueur=:utilisateur AND statut = '.Echanges::$PROPOSITION, array(
            'id' => $_GET['id'], 'utilisateur' => $utilisateur->id
        ));

        if (!$echange)
        {
            echo 'Aucun échange trouvé';
            exit();
        }

        $objet_demande = Biens::model()->find('id=:id AND utilisateur=:utilisateur AND disponible=1', array(
            'utilisateur' => $echange->troque,
            'id' => $echange->objet_demande,
        ));

        if (!$objet_demande)
        {
            echo "L'objet demandé n'est pas disponible";
            exit();
        }

        $propositions = Propositions::model()->findAll('echange=:echange OR bien=:objet_retenu OR bien=:objet_retenu OR objet=:objet_demande OR objet=:objet_demande', array(
            'echange'=>$echange->id,
            'objet_demande' => $objet_demande->id,
            'objet_retenu' => $objet_retenu->id,
        ));

        echo $this->renderPartial('_choisir', array(
            'echange' => $echange,
            'objet_demande' => $objet_demande,
            'propositions' => $propositions,
        ));
    }

}
