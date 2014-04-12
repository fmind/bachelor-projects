<?php $this->pageTitle = 'Catalogue'; ?>

<div id="body">
    <h1><?= $titre ?></h1>
    
    <?= $this->renderPartial('_livre', array('titre' => 'Mes biens', 'biens' => $biens, 'pages' => $pages)); ?>
</div>