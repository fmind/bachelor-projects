<?php $this->pageTitle=Yii::app()->name. "- Traitements"; ?>

<div class="traitement">
    <a href="/traitement/demandeDisponibilite">DEMANDE DISPONIBILITÉ</a>
</div>

<div class="traitement">
    <a href="/traitement/confirmationReservation">CONFIRMATION RÉSERVATION</a>
</div>

<div class="traitement">
    <a href="/traitement/annulationReservation">ANNULATION RÉSERVATION</a>
</div>

<div class="traitement">
    <a href="/traitement/demandeAttente">DEMANDES EN ATTENTE</a>
</div>

<div class="traitement">
    <a href="/traitement/versementArrhes">VERSEMENT ARRHES</a>
</div>

<div class="traitement">
    <a href="/traitement/receptionPaiement">RÉCEPTION PAIEMENT</a>
</div>

<div class="traitement">
    <a href="/traitement/nouvelleLocation">NOUVELLE LOCATION</a>
</div>

<div class="traitement">
    <a href="/traitement/repriseGestion">REPRISE GESTION</a>
</div>

<div class="traitement">
    <a href="/traitement/analyseEcheances">ANALYSE ÉCHÉANCES</a>
</div>

<style>
.traitement {
    background: url('/css/bg.gif');
    width: 150px;
    height: 35px;
    margin: 20px 60px;
    padding: 15px;
    border-radius: 20px;
    text-align: center;
    float: left;
}

.traitement a {
    color: black;
    font-size: 15px;
    text-decoration: none;
}

.bouton_principal a:hover {
    color: white;
}
</style>
