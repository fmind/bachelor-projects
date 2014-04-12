<?php
    $this->pageTitle=Yii::app()->name . ' - Gestions';
    $this->breadcrumbs = array(
        'Gestions' => '/gestion/',
    );
?>

<h1>Liste des objets de la base</h1>

<p>
    Cliquez sur un lien pour créer, modifier et supprimer les objets de la base.
</p>

<div class="span-10 prepend-1 bloc_gestion">
    <h3>Les stations</h3>

    <ul>
        <li><a href="/station/">Stations</a></li>
        <li><a href="/service/">Services</a></li>
        <li><a href="/activite/">Activités</a></li>
        <li><a href="/particularite/">Particularités</a></li>
    </ul>
</div>

<div class="span-10 prepend-1 right bloc_gestion">
    <h3>Les hébergements</h3>

    <ul>
        <li><a href="/prestataire/">Prestataires</a></li>
        <li><a href="/hebergement/">Hébergements</a></li>
        <li><a href="/disponibilite/">Disponibilités</a></li>
    </ul>
</div>

<div class="clear"></div>
<br />

<div class="span-10 prepend-1 bloc_gestion">
    <h3>Vos clients</h3>

    <ul>
        <li><a href="/client/">Clients</a></li>
        <li><a href="/demande/">Demandes</a></li>
        <li><a href="/reservation/">Réservations</a></li>
        <li><a href="/paiement/">Paiements</a></li>
    </ul>
</div>

<div class="span-10 prepend-1 bloc_gestion right">
    <h3>Autre</h3>

    <ul>
        <li><a href="/saison/">Saisons</a></li>
        <li><a href="/typeHeberg/">Types d'hébergement</a></li>
        <li><a href="/typeActivite/">Types d'activités</a></li>
        <li><a href="/typePrest/">Type de prestation</a></li>
        <li><a href="/typePaiement/">Types de paiement</a></li>
    </ul>
</div>

<style>
.bloc_gestion {
    padding: 10px 0px 0px 20px;
}
</style>
