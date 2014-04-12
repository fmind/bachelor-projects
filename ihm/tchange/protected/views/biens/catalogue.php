<?php $this->pageTitle = 'Catalogue'; ?>

<div id="body">
    <h1><?= $titre ?></h1>

    <div id="fil-ariane">
        <ul>
            <!--Liste des catégories-->
            <li class="categories">
                Catégories
                <ul>
                    <!--élément de menu-->
                    <? foreach (Categories::model()->findAll() as $categorie): ?>
                    <li>
                        <?= CHtml::link($categorie->nom, '/biens/catalogue/?cat=' . $categorie->id); ?><span>&gt;</span>
                        <!--éléments du sous menu-->
                        <ul>
                            <? foreach (SousCategories::model()->findAll('categorie=:categorie', array('categorie' => $categorie->id)) as $sous_categorie): ?>
                                <li class="sous-categorie"><?= CHtml::link($sous_categorie->nom, '/biens/catalogue/?scat=' . $sous_categorie->id); ?></li>
                            <? endforeach; ?>
                        </ul>
                    </li>
                    <? endforeach; ?>
                </ul>
            </li>
            <li>
                &gt;
            </li>

            <? if ($fil):?>

            <li class="categorie"><?= $fil ?></li>

            <? elseif (isset($_GET['scat'])): ?>

            <? $souscat_selectionnee = SousCategories::model()->find('id=:id', array('id' => $_GET['scat'])); ?>
            <!--Catégorie concernée-->
            <li class="categorie">
                <?= $souscat_selectionnee->categorieRel->nom ?>
                <ul>
                    <? foreach ($souscat_selectionnee->categorieRel->sousCategories as $sous_cat): ?>
                    <li class="sous-categorie"><?= CHtml::link($sous_cat->nom, '/biens/catalogue/?scat=' . $sous_cat->id); ?></li>
                    <? endforeach; ?>
                </ul>
            </li>
            <li>
                &gt;
            </li>
            <!--Sous catégorie concernée-->
            <li class="sous-categorie">
                <?= $souscat_selectionnee->nom ?>
            </li>

            <? elseif (isset($_GET['cat'])): ?>

            <? $cat_selectionnee = Categories::model()->find('id=:id', array('id' => $_GET['cat'])); ?>
            <!--Catégorie concernée-->
            <li class="categorie">
                <?= $cat_selectionnee->nom ?>
                <ul>
                    <? foreach ($cat_selectionnee->sousCategories as $sous_cat): ?>
                    <li class="sous-categorie"><?= CHtml::link($sous_cat->nom, '/biens/catalogue/?scat=' . $sous_cat->id); ?></li>
                    <? endforeach; ?>
                </ul>
            </li>
            <? endif; ?>
        </ul>
    </div>
    <?= $this->renderPartial('_livre', array('titre' => 'Catalogue', 'biens' => $biens, 'pages' => $pages)); ?>
</div>