<div id="echange_proposer" class="popup">
    <div class="titre">
        <a href="javascript:popup_fermer();" class="fermer">X</a>
        <h3>Selectionner parmi les objets du demandeur</h3>
    </div>
    <div class="gauche icones">

        <h4>A Sélectionner</h4>
        <ul id="echange_biens_disponibles">
            <? foreach ($biens as $bien): ?>
                <li class="item <?= (in_array($bien->id, $propositions_biens)) ? 'non' : '' ?>" id="bien_disponible_<?= $bien->id ?>">
                    <span onclick="proposition_ajouter(<?= $echange->id ?>, <?= $bien->id ?>);">
                        <h5 class="tipb"><?= $bien->nom ?></h5>
                        <div class="illustration"><span class="illustration"><img src="<?= Biens::getPhotoSrc($bien) ?>" alt="<?= $bien->nom ?> de <?= $bien->utilisateurRel->login ?>" /></span></div>
                        <div class="infos">
                            <p class="description">
                                <?= $bien->description ?>
                            </p>
                            <div class="complement">
                                <p class="categorie">
                                    <span>Catégorie : </span><?= $bien->sousCategorieRel->categorieRel->nom ?> > <?= $bien->sousCategorieRel->nom ?>
                                </p>
                                <p class="tags">
                                    <span>Mots-clés : </span><?= str_replace(",", ", ", $bien->tags) ?>
                                </p>
                            </div>
                        </div>
                        <a class="demander border-radius-3">Cliquer pour proposer</a>
                    </span>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
    <div class="droite icones">
        <h4>Sélectionné</h4>
        <ul id="echange_biens_proposes">
            <? foreach ($biens as $bien): ?>
                <li class="item <?= (in_array($bien->id, $propositions_biens)) ? '' : 'non' ?>" id="bien_propose_<?= $bien->id ?>">
                    <span onclick="proposition_supprimer(<?= $echange->id ?>, <?= $bien->id ?>);">
                        <h5 class="tipb"><?= $bien->nom ?></h5>
                        <div class="illustration"><span class="illustration"><img src="<?= Biens::getPhotoSrc($bien); ?>" alt="<?= $bien->nom ?>" /></span></div>
                        <div class="infos">
                            <p class="description">
                                <?= $bien->description ?>
                            </p>
                            <div class="complement">
                                <p class="categorie">
                                    <span>Catégorie : </span><?= $bien->sousCategorieRel->categorieRel->nom ?> > <?= $bien->sousCategorieRel->nom ?>
                                </p>
                                <p class="tags">
                                    <span>Mots-clés : </span><?= str_replace(",", ", ", $bien->tags) ?>
                                </p>
                            </div>
                        </div>
                        <a class="demander border-radius-3">Cliquer pour retirer</a>
                    </span>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
</div>