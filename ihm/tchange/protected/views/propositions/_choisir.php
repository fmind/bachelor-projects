<div id="echange_choisir" class="popup">
    <div class="titre">
        <a href="javascript:popup_fermer();" class="fermer">X</a>
        <h3>Choisir</h3>
    </div>

    <div class="gauche icones">
        <h4>Objet demandé</h4>

        <ul id="echange_objet_demande">
            <li class="item">
                <h5 class="tipb"><?= $objet_demande->nom ?></h5>
                <div class="illustration"><span class="illustration"><img src="<?= Biens::getPhotoSrc($objet_demande) ?>" alt="<?= $objet_demande->nom ?> de <?= $objet_demande->utilisateurRel->login ?>" /></span></div>
                <div class="infos">
                    <p class="description">
                        <?= $objet_demande->description ?>
                    </p>
                    <div class="complement">
                        <p class="categorie">
                            <span>Catégorie : </span><?= $objet_demande->sousCategorieRel->categorieRel->nom ?> > <?= $objet_demande->sousCategorieRel->nom ?>
                        </p>
                        <p class="tags">
                            <span>Mots-clés : </span><?= str_replace(",", ", ", $objet_demande->tags) ?>
                        </p>
                    </div>
                </div>
            </li>
        </ul>

    </div>


    <div class="droite icones">
        <h4>Objet à choisir</h4>
        <ul id="echange_biens_proposes">

            <? foreach ($propositions as $proposition): ?>
                <? $bien = Biens::model()->find('id=:id', array('id' => $proposition->bien)) ?>
                <li class="item">
                    <span onclick="echange_validation(<?= $echange->id ?>, <?= $bien->id ?>);">
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
                        <a class="demander border-radius-3">Cliquer pour choisir</a>
                    </span>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
</div>