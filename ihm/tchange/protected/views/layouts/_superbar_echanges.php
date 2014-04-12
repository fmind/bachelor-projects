<ul>
    <li id="bar_1" class="bar_nb">
        <h5>1</h5>
    <h7>Selectionner</h7>
    <ul id="bar_echanges_selection" class="troclist">
        <? foreach ($echanges_selection as $echange): ?>
            <li>
                <div class="mini-illustration">
                    <span class="mini-illustration">
                        <img src="<?= Biens::getPhotoSrc($echange->objetDemandeRel) ?>" alt="<?= $echange->objetDemandeRel->nom ?>"/>
                    </span>
                    <h6>
                        <?= $echange->objetDemandeRel->nom ?>
                        <span>
                            <a class="fermer" href="javascript:echange_supprimer(<?= $echange->id ?>);"></a>
                        </span>
                    </h6>
                </div>
            </li>
        <? endforeach ?>
    </ul>
</li>
<li id="bar_2" class="bar_nb">
    <h5>2</h5>
<h7>Proposer</h7>
<ul id="bar_echanges_proposition" class="troclist">
    <? foreach ($echanges_proposition_todo as $echange): ?>
        <li>
            <div class="mini-illustration">
                <span class="mini-illustration">
                    <img src="<?= Biens::getPhotoSrc($echange->objetDemandeRel) ?>" alt="<?= $echange->objetDemandeRel->nom ?>"/>
                </span>
                <h6>
                    <?= $echange->objetDemandeRel->nom ?>
                    <span>
                        <br/>
                        <a class="proposer" href="javascript:proposition_repondre(<?= $echange->id ?>);">PROPOSER</a>
                        <a class="fermer" href="javascript:echange_annuler(<?= $echange->id ?>);"></a>
                    </span>
                </h6>
            </div>
        </li>
    <? endforeach ?>
    <? foreach ($echanges_proposition as $echange): ?>
        <li>
            <div class="mini-illustration">
                <span class="mini-illustration">
                    <img src="<?= Biens::getPhotoSrc($echange->objetDemandeRel) ?>" alt="<?= $echange->objetDemandeRel->nom ?>"/>
                </span>
                <h6>
                    <?= $echange->objetDemandeRel->nom ?>
                    <span>
                        <br/>
                        <a class="proposer" href="javascript:proposition_repondre(<?= $echange->id ?>);">MODIFIER</a>
                        <a class="fermer" href="javascript:echange_annuler(<?= $echange->id ?>);"></a>
                    </span>
                </h6>
            </div>
        </li>
    <? endforeach ?>
</ul>
</li>
<li id="bar_3" class="bar_nb">
    <h5>3</h5>
<h7>Finaliser</h7>
<ul id="bar_echanges_validation" class="troclist">
    <? foreach ($echanges_validation as $echange): ?>
        <li>
            <div class="mini-illustration">
                <span class="mini-illustration">
                    <img src="<?= Biens::getPhotoSrc($echange->objetDemandeRel) ?>" alt="<?= $echange->objetDemandeRel->nom ?>"/>
                </span>
                <h6>
                    <?= $echange->objetDemandeRel->nom ?>
                    <span>
                        <br/>
                        <a class="choisir" href="javascript:proposition_choisir(<?= $echange->id ?>);">CHOISIR</a>
                        <a class="fermer" href="javascript:echange_annuler(<?= $echange->id ?>);"></a>
                    </span>
                </h6>
            </div>
        </li>
    <? endforeach ?>
</ul>
</li>
</ul>
<ul>
    <li id="bar_4" class="bar_nb">
        <ul id="bar_echanges_historique" class="troclist">
            <? foreach ($echanges_historique as $echange): ?>
                <li>
                    <div class="mini-illustration">
                        <span class="mini-illustration">
                            <img src="<?= Biens::getPhotoSrc($echange->objetDemandeRel) ?>" alt="<?= $echange->objetDemandeRel->nom ?>"/>
                        </span>
                        <h6>
                            <?= $echange->objetDemandeRel->nom ?>
                            <br/>
                            <?= ($echange->statut == Echanges::$ACCEPTE) ? 'Accepté' : 'Refusé' ?>
                        </h6>
                    </div>
                </li>
            <? endforeach ?>
        </ul>
    </li>
</ul>
