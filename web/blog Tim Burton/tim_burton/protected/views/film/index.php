<?php
  $this->pageTitle='Filmographie';
  $this->activeEntry='film';
?>

<h1 class="align_center">Filmographie</h1>
<br />

<?php foreach($films as $film): ?>

<article class="film">
  <div class="affiche left">
    <a href="<?php echo Yii::app()->baseUrl.'/images/films/'.$film->id.'.jpg' ?>">
      <?php echo CHtml::image(
                    Yii::app()->baseUrl.'/images/films/'.$film->id.'.jpg',
                    'Affiche du film '.$film->titre,
                    array('width' => '150', 'height' => '200'));
      ?>
    </a>
  </div>

  <h3 class="right"><?php echo CHtml::encode($film->date_sortie) ?></h3>
  <br />
  <h2><?php echo CHtml::encode($film->titre) ?></h2>

  <br />
  
  <ul class="classic_font surbrillance">
    <li>Genre : <?php echo CHtml::encode($film->genres) ?></li>
    <li>Acteurs principaux : <?php echo CHtml::encode($film->acteurs_principaux) ?></li>
  </ul>

  <div class="clear"></div>
  <br />
    
  <p class="classic_font surbrillance">
    <?php echo CHtml::encode($film->synopsis) ?>
  </p>
</article>

<div class="clear"></div>
<br /><hr /><br />

<?php endforeach; ?>

<script>
  $('.film .affiche a').lightBox();
</script>