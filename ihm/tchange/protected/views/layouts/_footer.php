<div id="footer">
    <ul>
        <li><?= CHtml::link('Accueil', '/'); ?></li>
        <li>&bull;</li>
        <li><?= CHtml::link('Catalogue', '/biens/catalogue'); ?></li>
        <li>&bull;</li>
        <li><?= CHtml::link('Recherche', '', array('onclick' => "setFocus('txtRecherche')")); ?></a></li>
        <? if (Yii::app()->user->isGuest): ?>
        <li>&bull;</li>
        <li style="position:relative;" class="tipb"><?= CHtml::link('Inscription', 'javascript:inscrire(30);', array('id' => 'hlInscription')); ?></a></li>
        <? endif; ?>
        <li>&bull;</li>
        <li><?= CHtml::link('Contact', '/site/contact'); ?></li>
    </ul>
</div>