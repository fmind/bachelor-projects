<?php

class EchangesController extends Controller
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
                'actions'=>array('superbar', 'valider', 'supprimer', 'annuler'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    /**
     * Rafraîchi la superbar
     */
    public function actionSuperbar()
    {
        $utilisateur = Utilisateurs::connecte();

        $echanges = new Echanges();
        $echanges_utilisateur = $echanges->findAll('troqueur=:utilisateur OR troque=:utilisateur', array('utilisateur' => $utilisateur->id));

        $echanges_selection = array();
        $echanges_proposition = array();
        $echanges_proposition_todo = array();
        $echanges_validation = array();
        $echanges_historique= array();
        foreach ($echanges_utilisateur as $echange)
        {
            // Les biens que j'ai sélectionné (= panier)
            if ($echange->statut == Echanges::$SELECTION && $echange->troqueur == $utilisateur->id)
                $echanges_selection[] = $echange;
            // Les biens auxquels je dois soumettre une liste de proposition
            if ($echange->statut == Echanges::$SELECTION && $echange->troque == $utilisateur->id)
                $echanges_proposition_todo[] = $echange;
            // Les biens auxquels j'ai donné une liste de proposition (je peux la modifier)
            if ($echange->statut == Echanges::$PROPOSITION && $echange->troque == $utilisateur->id)
                $echanges_proposition[] = $echange;
            // Les biens en attente de validation
            if ($echange->statut == Echanges::$PROPOSITION && $echange->troqueur == $utilisateur->id)
                $echanges_validation[] = $echange;
            // Historique des échanges (accepté ou refusé)
            if ($echange->statut == Echanges::$ACCEPTE || $echange->statut == Echanges::$REFUSE)
                $echanges_historique[] = $echange;
        }

        $this->renderPartial('//layouts/_superbar_echanges', array(
           'echanges_selection' => $echanges_selection,
           'echanges_proposition_todo' => $echanges_proposition_todo,
           'echanges_proposition' => $echanges_proposition,
           'echanges_validation' => $echanges_validation,
           'echanges_historique' => $echanges_historique,
        ));
    }

    /**
     * Valide définitivement un échange
     * @note seulement statut PROPOSITION
     */
    public function actionValider()
    {
        $utilisateur = Utilisateurs::connecte();

        $echange = Echanges::model()->find('id=:id AND troqueur=:utilisateur AND statut='.Echanges::$PROPOSITION, array(
            'id' => $_GET['id'], 'utilisateur' => $utilisateur->id
        ));
        $objet_retenu = Biens::model()->find('id=:id AND utilisateur=:utilisateur AND disponible=1', array(
            'id' => $_POST['objet_retenu'], 'utilisateur' => $utilisateur->id
        ));
        $objet_demande = Biens::model()->find('id=:id AND utilisateur=:utilisateur AND disponible=1', array(
            'id' => $echange->objet_demande, 'utilisateur' => $echange->troque
        ));

        if (!$echange || !$objet_retenu || !$objet_demande)
        {
            echo 'Aucun échange trouvé';
            exit();
        }

        $objet_demande->disponible = 0;
        $objet_demande->save();

        $objet_retenu->disponible = 0;
        $objet_retenu->save();

        $echange->objet_retenu = $objet_retenu->id;
        $echange->statut = Echanges::$ACCEPTE;
        $echange->save();

        Propositions::model()->deleteAll('echange=:echange OR bien=:objet_demande OR bien=:objet_retenu OR objet=:objet_retenu OR objet=:objet_demande', array(
            'echange' => $echange->id,
            'objet_demande' => $objet_demande->id,
            'objet_retenu' => $objet_retenu->id,
        ));
    }

    /**
     * Supprime un échange définitivement de la base
     * @note seulement statut SELECTION
     */
    public function actionSupprimer()
    {
        $utilisateur = Utilisateurs::connecte();

        $echange = Echanges::model()->find('id=:id AND troqueur=:utilisateur AND statut=:statut', array(
            'id' => $_GET['id'], 'utilisateur' => $utilisateur->id, 'statut' => Echanges::$SELECTION
        ));

        if (!$echange)
        {
            echo 'Aucun échange trouvé';
            exit();
        }

        $echange->delete();
    }

    /**
     * Annule un échange en changeant son statut à ANNULER
     * @note possible depuis tous les statuts sauf ACCEPTE et REFUSE
     */
    public function actionAnnuler()
    {
        $utilisateur = Utilisateurs::connecte();

        $echange = Echanges::model()->find('id=:id AND (troqueur=:utilisateur OR troque=:utilisateur)', array(
            'id' => $_GET['id'], 'utilisateur' => $utilisateur->id
        ));

        if (!$echange)
        {
            echo 'Aucun échange trouvé';
            exit();
        }

        $echange->statut = Echanges::$REFUSE;
        $echange->save();
    }
}
