<div class="catalogue <?= (isset($_COOKIE['catalogue_mode']) && $_COOKIE['catalogue_mode'] == 1 ) ? 'details' : 'icones' ?>">
    <ul>
        <? foreach ($biens as $bien): ?>
            <?
            if (Yii::app()->user->isGuest):                     // Utilisateur non connecté
                $lien = 'javascript:inscrire(30)';
                $bt_text = "Demander l'echange";
            elseif (Utilisateurs::connecte()->id == $bien->utilisateur): // Objet de l'utilisateur connecté
                $lien = '/biens/modifier/' . $bien->id;
                $bt_text = 'Modifier';
            else:                                               // Objet d'un autre utilisateur
                $lien = 'javascript:bien_selectionner(' . $bien->id . ');';
                $bt_text = "Demander l'échange";
            endif;
            ?>
            <li class="item">
                <? if (isset($_COOKIE['catalogue_mode']) && $_COOKIE['catalogue_mode'] == 1 ): ?>
                    <div class="illustration"><span class="illustration"><img src="<?= Biens::getPhotoSrc($bien) ?>" alt="<?= $bien->nom ?> de <?= $bien->utilisateurRel->login ?>" /></span></div>
                    <div class="infos">
                        <h5 class="tipb"><?= $bien->nom ?><a href="javascript:message_question(<?= $bien->utilisateur ?>, <?= $bien->id ?>);" class="question" data-tooltip="Posez votre question au propriétaire de l'objet">?</a></h5>
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
                        <a class="demander border-radius-3" onclick="if('<?= $lien ?>' != '#') window.location.href ='<?= $lien ?>';"><?= $bt_text ?></a>
                    </div>
                <? else: ?>
                    <h5 class="tipb"><?= $bien->nom ?><a href="javascript:message_question(<?= $bien->utilisateur ?>, <?= $bien->id ?>);" class="question" data-tooltip="Posez votre question au propriétaire de l'objet">?</a></h5>
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
                    <a class="demander border-radius-3" onclick="if('<?= $lien ?>' != '#') window.location.href ='<?= $lien ?>';"><?= $bt_text ?></a>
                <? endif; ?>

            </li>
        <? endforeach; ?>
    </ul>

    <div id="pagination">
        <?
        $this->widget('CLinkPager', array(
            'pages' => $pages,
        ))
        ?>
    </div>

    <div class="options">
        <a href="javascript:catalogue_mode(0);">Icônes</a> | <a href="javascript:catalogue_mode(1);">Détails</a>

        <select class="biens_par_page" onchange="javascript:catalogue_biens_par_page($(this).val());">
            <? for ($i=3; $i<=30; $i+=3): ?>
            <option <?= (isset($_COOKIE['catalogue_biens_par_page']) && $_COOKIE['catalogue_biens_par_page'] == $i) ? 'selected' : '' ?>><?= $i ?></option>
            <? endfor; ?>
        </select>
    </div>
</div>