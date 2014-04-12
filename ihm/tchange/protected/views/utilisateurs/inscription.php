<div id="inscription_popup" class="popup">
    <div class="titre">
        <a href="javascript:popup_fermer();" class="fermer">X</a>
        <h3>Inscrivez vous !</h3>
    </div>

    <?= $this->renderPartial('//utilisateurs/_formulaire', array('model'=>$model)); ?>
</div>