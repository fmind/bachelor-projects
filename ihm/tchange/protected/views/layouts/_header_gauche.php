<div id="gauche" class="post-it">
    <span class="tipr2" style="position:relative"><h6 id="besoinAide" data-tooltip="Sélectionnez une action dans la liste ci-dessous pour obtenir une aide approriée">Besoin d'aide ?</h6></span>
    <select id="menuAide" onchange="this.blur();" onblur="afficherAide();" class="border-radius-2 border-gris-clair gris bg-blanc">
        <option value="">S&eacute;lectionnez</option>
        <option value="4">S'inscrire</option>
        <option value="1">Ajouter un objet</option>
        <option value="2">Chercher un objet</option>
        <option value="3">&Eacute;changer un objet</option>
    </select>
    <div class="bas tipb">
        <?= CHtml::link('', '/', array('id' => 'btAccueil', 'data-tooltip' => "Retourner à la page d'accueil", 'class' => 'border-radius-3 ombre-5 border-gris-clair bg-blanc accueil')) ?>
        <?= CHtml::link('', '/biens/catalogue', array('id' => 'btCatalogue', 'data-tooltip' => "Consulter le catalogue", 'class' => 'border-radius-3 ombre-5 border-gris-clair bg-blanc catalogue')) ?>
        <?= CHtml::link('', (Yii::app()->user->isGuest) ? 'javascript:inscrire(20);' : '/biens/proposer', array('id' => 'btAjouter', 'data-tooltip' => "Ajouter un objet à échanger", 'class' => 'border-radius-3 ombre-5 border-gris-clair bg-blanc ajouter')) ?>
    </div>
</div>