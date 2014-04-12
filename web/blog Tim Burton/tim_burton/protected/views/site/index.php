<?php
  $this->pageTitle='TIM BURTON par Freaxmind';
  $this->activeEntry='accueil';
?>

<h1 class="align_center">Bienvenue sur le site de Tim Burton</h1>
<h3 class="align_center">réalisé par <a href="http://freaxmind.no-ip.info">Freaxmind</a> .</h3>

<br />

<div class="slideshow">
  <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/slide/1.jpg', 'Photo 1 du slide') ?>
  <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/slide/2.jpg', 'Photo 2 du slide') ?>
  <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/slide/3.jpg', 'Photo 3 du slide') ?>
  <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/slide/4.jpg', 'Photo 4 du slide') ?>
  <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/slide/5.jpg', 'Photo 5 du slide') ?>
  <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/slide/6.jpg', 'Photo 6 du slide') ?>
  <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/slide/7.jpg', 'Photo 7 du slide') ?>
  <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/slide/8.jpg', 'Photo 8 du slide') ?>
</div>

<script>
  $(document).ready(function() {
    $('.slideshow').cycle({
      fx: 'zoom,shuffle,wipe,toss',
      speed: 1500,
      timeout: 1500
	});
  });
</script>