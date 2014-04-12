<?php
  $this->pageTitle='Mes Billets';
  $this->activeEntry='billet';
?>

<?php foreach($billets as $billet): ?>

<article>
  <hgroup>
    <h2><a href="<?php echo $billet->getURL(); ?>"><?php echo CHtml::encode($billet->titre) ?></a></h2>
  </hgroup>

  <p class="classic_font surbrillance">
    <?php echo substr(strip_tags($billet->contenu), 0, 250) ?> ...
  </p>
</article>

<br />

<?php endforeach; ?>