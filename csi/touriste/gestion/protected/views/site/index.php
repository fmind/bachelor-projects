<?php $this->pageTitle=Yii::app()->name; ?>

<p class="align_center">
    Naviguez sur le site à l'aide du menu principale ou des boutons ci-dessous.
    <br /><br />
    Vous pouvez revenir à cette page en cliquant sur le logo ou sur "Accueil" dans le menu.
</p>

<div class="bouton_principal">
    <a href="/gestion/">GESTIONS</a>
</div>

<div class="bouton_principal">
    <a href="/interrogation/">INTERROGATIONS</a>
</div>

<div class="bouton_principal">
    <a href="/traitement/">TRAITEMENTS</a>
</div>

<style>
.bouton_principal {
    background: url('/css/bg.gif');
    height: 75px;
    width: 250px;
    border-radius: 20px;
    margin: 20px auto;
    text-align: center;
}

.bouton_principal a {
    color: black;
    font-size: 20px;
    text-decoration: none;
    position: relative;
    top: 22px;
}

.bouton_principal a:hover {
    color: white;
}
</style>
