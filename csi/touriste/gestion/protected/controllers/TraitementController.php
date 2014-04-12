<?php

class TraitementController extends Controller
{
    /**
     * Affiche la liste des traitements
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * Créer une nouvelle demande à satisfaire pour un client
     */
    public function actionDemandeDisponibilite()
    {
        $model = new Demande('traitement');

        if ($_POST['Demande'])
        {
            $model->attributes = $_POST['Demande'];
            $model->CODEATTENTE = 0;
            $model->ETATDEM = "renvoie proposition";
            $model->DATDEM = date('Y-m-d');

            if ($model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('success', "La demande a été ajoutée avec succès !<br /> Des propositions serons envoyées prochainement.");
                $model = new Demande('traitement');
            }
        }

        $this->render('demandeDisponibilite', array(
            'model' => $model,
        ));
    }

    /**
     * Transforme une demande en réservation
     */
    public function actionConfirmationReservation()
    {
        $model = new Reservation('traitement');

        // Fixe la demande (paramètre URL)
        if (isset($_GET['id']))
        {
            $model->NDEM = $_GET['id'];
        }

        // Met la demande en attente si aucun hébergement n'est bon
        if (isset($_GET['attente']) && isset($_GET['noheberg']) && isset($_GET['ndem']))
        {
            $demande = Demande::model()->findByPk($_GET['ndem']);
            $demande->ETATDEM = 'en attente';
            $demande->CODEATTENTE = 1;
            $demande->save();

            Yii::app()->user->setFlash('success', "La demande a été mise en attente pour cet hébergement !<br /> Vous pouvez transformer cette demande en réservation en consultant les demandes en attente dans l'interface.");

            $this->render('confirmationReservation', array(
                'model' => $model,
            ));
            return;
        }

        // Créer la réservation
        if ($_POST['Reservation'])
        {
            $model->attributes = $_POST['Reservation'];
            $demande = $model->demandeRel;
            $hebergement = $model->hebergementRel;
            $saison = Saison::model()->find(":datedebut BETWEEN DATEDEBS AND DATEFINS AND :datefin BETWEEN DATEDEBS AND DATEFINS ", array('datedebut' => $demande->DATEDEBUTRES, 'datefin' => $demande->DATEFINRES));
            $apour = APour::model()->find('NOHEBERG=:noheberg AND NOSAISON=:nosaison', array('noheberg' => $hebergement->NOHEBERG, 'nosaison' => $saison->NOSAISON));

            $model->DATERES = date('Y-m-d');
            $model->MONTANTRES = $apour->PRIX;
            $model->DATANNUL = NULL;
            $model->ETATRES = "en attente arrhes";
            $arrhes = $model->MONTANTRES * 0.2; // Calcul d'arrhes

            if ($model->validate() && $model->save())
            {
                $demande->ETATDEM = "validé";
                $demande->save();

                Yii::app()->user->setFlash('success', "La réservation a été confirmée !<br /> Merci d'envoyer les arrhes ($arrhes €) rapidement pour confirmer le séjour.");
                $model = new Reservation('traitement');
            }
            else // En cas d'erreur, propose de mettre en attente
            {
                $model->mettre_en_attente = true;
            }
        }

        $this->render('confirmationReservation', array(
            'model' => $model,
        ));
    }

    /**
     * Annule une réservation ou une demande en cours
     */
    public function actionAnnulationReservation()
    {
        $demande = new Demande();
        $reservation = new Reservation();

        // Annulation demande
        if (isset($_POST['Demande']))
        {
            $demande = Demande::model()->findByPk($_POST['Demande']['NDEM']);
            $demande->ETATDEM = 'annulé';
            $demande->save();

            Yii::app()->user->setFlash('success', "La demande en attente a été annulée avec succès !");

            $demande = new Demande();
        }

        // Annulation réservation
        if (isset($_POST['Reservation']))
        {
            $reservation = reservation::model()->findByPk($_POST['Reservation']['NORES']);
            if ($reservation->ETATRES == "en attente arrhes")
            {
                $reservation->ETATRES = "annule";
                $reservation->DATANNUL = date('Y-m-d');
                $reservation->save();
                Yii::app()->user->setFlash('success', "La réservation en attente de versement d'arrhes a été annulée avec succès !");

                $reservation = new Reservation();
            }
            else if ($reservation->ETATRES == 'effective' || $reservation->ETATRES == "complete")
            {
                $reservation->ETATRES = "annule";
                $reservation->DATANNUL = date('Y-m-d');
                $reservation->save();
                $demande = $reservation->demandeRel;

                $montant = $reservation->MONTANTRES;
                $arrhes = $montant * 0.2;
                $total = Yii::app()->db->createCommand("SELECT SUM(MONTANTPAIE) as sum FROM Paiement WHERE NORES = ".$reservation->NORES)->queryScalar();

                // Selon le montant restant à payer
                if ($reservation->ASSURANCE && isset($_POST['PREVU']))
                {
                    Yii::app()->user->setFlash('success', "La réservation effective a été annulée avec succès !<br />L'assurance du client prendra en charge le remboursement.");
                }
                else
                {
                    $date_location = new Datetime($demande->DATEDEBUTRES);
                    $date_location_15 = new Datetime($demande->DATEDEBUTRES);
                    $date_location_30 = new Datetime($demande->DATEDEBUTRES);
                    $date_location_15->sub(new DateInterval("P15D"));
                    $date_location_30->sub(new DateInterval("P30D"));
                    $date_annulation = new Datetime();

                    if ($date_annulation < $date_location_30)
                    {
                        Yii::app()->user->setFlash('success', "La réservation effective a été annulée avec succès !<br />Le client n'a rien à verser (annulé au moins 30 jours avant le séjour)");
                    }
                    else if ($date_annulation >= $date_location_30 && $date_annulation < $date_location_15)
                    {
                        $restant = ($montant - $arrhes) * 0.5 - ($total - $arrhes);
                        if ($restant > 0)
                        {
                            Yii::app()->user->setFlash('success', "La réservation effective a été annulée avec succès !<br />Le client doit encore verser $restant € (annulé entre 15 et 30 jours avant le début du séjour)");
                        }
                        else if ($restant < 0)
                        {
                            $paiement = new Paiement();
                            $paiement->NORES = $reservation->NORES;
                            $paiement->NOTYPPAIE = 1;
                            $paiement->LIBELLEPAIE = "remboursement annulation";
                            $paiement->MONTANTPAIE = $restant;
                            $paiement->DATEPAIE = date('Y-m-d');
                            $paiement->REMBOURSEPAIE = 1;
                            $paiement->save();

                            $restant = 0 - $restant;

                            Yii::app()->user->setFlash('success', "La réservation effective a été annulée avec succès !<br />Le client a été remboursé de $restant € (annulé entre 15 et 30 jours avant le début du séjour)");
                        }
                        else
                        {
                            Yii::app()->user->setFlash('success', "La réservation effective a été annulée avec succès !<br />Le client a déjà payé la somme suffisante pour rembourser son annulation (annulé entre 15 et 30 jours avant le début du séjour)");
                        }
                    }
                    else if ($date_annulation >= $date_location_15 && $date_annulation <= $date_location)
                    {
                        $restant = ($montant - $arrhes) * 0.9 - ($total - $arrhes);
                        if ($restant > 0)
                        {
                            Yii::app()->user->setFlash('success', "La réservation effective a été annulée avec succès !<br />Le client doit encore verser $restant € (annulé au plus 15 jours avant le début du séjour)");
                        }
                        else if ($restant < 0)
                        {
                            $paiement = new Paiement();
                            $paiement->NORES = $reservation->NORES;
                            $paiement->NOTYPPAIE = 1;
                            $paiement->LIBELLEPAIE = "remboursement annulation";
                            $paiement->MONTANTPAIE = $restant;
                            $paiement->DATEPAIE = date('Y-m-d');
                            $paiement->REMBOURSEPAIE = 1;
                            $paiement->save();

                            $restant = 0 - $restant;

                            Yii::app()->user->setFlash('success', "La réservation effective a été annulée avec succès !<br />Le client a été remboursé de $restant € (annulé au plus 15 jours avant le début du séjour)");
                        }
                        else
                        {
                            Yii::app()->user->setFlash('success', "La réservation effective a été annulée avec succès !<br />Le client a déjà payé la somme suffisante pour rembourser son annulation (annulé au plus 15 jours avant le début du séjour)");
                        }
                    }
                }
            }

            $reservation = new Reservation();
        }

        $this->render('annulationReservation', array(
            'demande' => $demande,
            'reservation' => $reservation,
        ));
    }

    /**
     * Verse le premier paiement (arrhes)
     */
    public function actionVersementArrhes()
    {
        $model = new Paiement('traitement');

        if ($_POST['Paiement'])
        {
            $model->attributes = $_POST['Paiement'];
            $model->LIBELLEPAIE = "versement arrhes";
            $model->DATEPAIE = date('Y-m-d');
            $model->REMBOURSEPAIE = 0;
            $reservation = $model->reservationRel;
            $demande = $reservation->demandeRel;
            $arrhes = $reservation->MONTANTRES * 0.2;

            // Tests supplémentaires sur la date et le montant
            $date_limite = new Datetime($demande->DATEDEBUTRES);
            $date_limite->sub(new DateInterval('P8D'));

            if ($model->MONTANTPAIE != $arrhes)
                $model->addError('MONTANTPAIE', "Vous n'avez pas versé la somme requise pour compléter les arrhes ($arrhes €)");
            if (new Datetime() > $date_limite)
                $model->addError('NORES', "Le délai de 8 jours pour verser les arrhes est dépasé. Votre réservation a été automatique annulée");

            if (!$model->hasErrors() && $model->validate() && $model->save())
            {
                $reservation->ETATRES = 'effective';
                $reservation->save();
                $restant = $reservation->MONTANTRES - $arrhes;

                Yii::app()->user->setFlash('success', "Le versement d'arrhes a été réalisé !<br /> La réservation est maintenant effective.<br /> Il reste $restant € à payer avant le début du séjour");
                $model = new Paiement('traitement');
            }
        }

        $this->render('versementArrhes', array(
            'model' => $model,
        ));
    }

    /**
     * Créer un paiement (après le versement arrhes) pour rendre la réservation complète
     */
    public function actionReceptionPaiement()
    {
        $model = new Paiement('traitement');

        if ($_POST['Paiement'])
        {
            $model->attributes = $_POST['Paiement'];
            $model->LIBELLEPAIE = "reception paiement";
            $model->DATEPAIE = date('Y-m-d');
            $model->REMBOURSEPAIE = 0;
            $reservation = $model->reservationRel;
            $total = Yii::app()->db->createCommand("SELECT SUM(MONTANTPAIE) as sum FROM Paiement WHERE NORES = ".$model->NORES)->queryScalar();
            $montant = $reservation->MONTANTRES;
            $restant = $montant - $total;

            // Tests supplémentaires sur le montant
            $date_limite = new Datetime($demande->DATEDEBUTRES);
            if ($model->MONTANTPAIE > $restant)
                $model->addError('MONTANTPAIE', "Vous ne pouvez pas verser plus d'argent que le montant restant à payer ($restant €)");

            if (!$model->hasErrors() && $model->validate() && $model->save())
            {
                // Réservation complète
                if ($model->MONTANTPAIE == $restant)
                {
                    $reservation->ETATRES = 'complete';
                    $reservation->save();

                    Yii::app()->user->setFlash('success', "Le paiement a bien été reçu !<br /> La réservation est maintenant complète.<br />");
                }
                else // Réservation incomplète
                {
                    $restant -= $model->MONTANTPAIE;
                    Yii::app()->user->setFlash('success', "Le paiement a bien été reçu !<br /> Il reste $restant € à payer pour que la réservation soit complète.<br />");
                }

                $model = new Paiement('traitement');
            }
        }

        $this->render('receptionPaiement', array(
            'model' => $model,
        ));
    }

    /**
     * Créer un nouvel hébergement avec des disponibilités
     */
    public function actionNouvelleLocation()
    {
        $model = new Hebergement('traitement');

        if ($_POST['Hebergement'])
        {
            $model->attributes = $_POST['Hebergement'];
            $model->GESTIONAGENCE = 1;

            if (!$model->hasErrors() && $model->validate() && $model->save())
            {
                foreach ($_POST['Disponibilites'] as $nodispo)
                {
                    $dispo = new Dispo();
                    $dispo->NOHEBERG = $model->NOHEBERG;
                    $dispo->NODISP = $nodispo;
                    $dispo->save();
                }

                Yii::app()->user->setFlash('success', "L'hébergement a bien été ajouté !<br />");
            }
        }

        $this->render('nouvelleLocation', array(
            'model' => $model,
        ));
    }

    /**
     * Reprise de gestion par le prestataire (gestion directe)
     */
    public function actionRepriseGestion()
    {
        $model = new Hebergement('traitement');

        if ($_POST['Hebergement'])
        {
            $model = Hebergement::model()->findByPk($_POST['Hebergement']['NOHEBERG']);
            $model->GESTIONAGENCE = 0;

            $total = Yii::app()->db->createCommand("SELECT COUNT(*) as total FROM Reservation WHERE ETATRES IN ('en attente arrhes', 'effective', 'complete') AND NOHEBERG = ".$model->NOHEBERG)->queryScalar();
            if ($total)
                $model->addError('NOHEBERG', "Des réservations sont en cours pour cet hébergement. La reprise est impossible !");

            if (!$model->hasErrors() && $model->validate() && $model->save())
            {
                Yii::app()->user->setFlash('success', "Le prestataire a repris la gestion directe de l'agence !<br />");
            }
        }

        $this->render('repriseGestion', array(
            'model' => $model,
        ));
    }

    /**
     * Liste les demandes en attente
     */
    public function actionDemandeAttente()
    {
        $model = new Demande();
        $data_provider = $model->search();
        $data_provider->setCriteria(new CDBCriteria(array('condition' => "ETATDEM = 'en attente'")));

        // Envoie de nouvelles propositions au client
        if (isset($_GET['prop']) && isset($_GET['id']))
        {
            $demande = Demande::model()->findByPk($_GET['id']);
            $demande->ETATDEM = 'renvoie proposition';
            if ($demande->save())
                $this->redirect('/traitement/confirmationReservation/1'.$_GET['id']);
        }

        // Refuse la demande
        if (isset($_GET['ref']) && isset($_GET['id']))
        {
            $demande = Demande::model()->findByPk($_GET['id']);
            $demande->ETATDEM = 'annulé';
            $demande->save();
            $this->redirect(array('/traitement/demandeAttente'));
        }

        $this->render('demandeAttente', array(
            'data_provider' => $data_provider,
        ));
    }

    /**
     * Bénéfice, chiffre d'affaire et impayés
     */
    public function actionAnalyseEcheances()
    {
        // Réservations impayées
        $data_provider_res = new CSqlDataProvider("SELECT * FROM Reservation r INNER JOIN Demande d ON r.NDEM = d.NDEM INNER JOIN Client c ON d.NOCLIENT = c.NOCLIENT WHERE (ETATRES ='en attente arrhes' AND DATE_SUB(DATEDEBUTRES, INTERVAL 8 DAY) <= CURDATE()) OR (ETATRES = 'effective' AND DATEDEBUTRES <= CURDATE())");
        try {
            $data_provider_res->setTotalItemCount(count($data_provider_res->getData()));
        } catch (Expcetion $e) {}

        // Bénéfice par saison
        $saisons = new Saison();
        $data_provider_sais = $saisons->search();

        // Refuse la réservation
        if (isset($_GET['ref']) && isset($_GET['id']))
        {
            $reservation = Reservation::model()->findByPk($_GET['id']);
            $reservation->scenario = "refus";
            $reservation->ETATRES = 'refusé';
            $reservation->save();
            $this->redirect(array('/traitement/analyseEcheances'));
        }

        $this->render('analyseEchances', array(
            'data_provider_res' => $data_provider_res,
            'data_provider_sais' => $data_provider_sais,
        ));
    }
}
