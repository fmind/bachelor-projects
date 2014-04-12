<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <!-- Styles -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Satisfy">
    <?php echo CHtml::cssFile(Yii::app()->baseUrl.'/js/jquery-ui/css/smoothness/jquery-ui.css') ?>
    <?php echo CHtml::cssFile(Yii::app()->baseUrl.'/js/jquery-lightbox/css/jquery.lightbox.css') ?>
    <?php echo CHtml::cssFile(Yii::app()->baseUrl.'/css/design.css') ?>

    <!-- Scripts -->
    <?php echo CHtml::scriptFile(Yii::app()->baseUrl.'/js/jquery.js') ?>
    <?php echo CHtml::scriptFile(Yii::app()->baseUrl.'/js/jquery-ui/js/jquery-ui.js') ?>
    <?php echo CHtml::scriptFile(Yii::app()->baseUrl.'/js/jquery-lightbox/js/jquery.lightbox.js') ?>
    <?php echo CHtml::scriptFile(Yii::app()->baseUrl.'/js/jquery.cycle.js') ?>
    <?php echo CHtml::scriptFile(Yii::app()->baseUrl.'/js/prefixfree.min.js') ?>
    <?php echo CHtml::scriptFile(Yii::app()->baseUrl.'/js/fonctions.js') ?>

    <script>
      $(document).ready(function() {
        menu_active('<?php echo $this->activeEntry ?>');
      });
    </script>

    <!-- Meta -->
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  </head>
  <body>

    <header>
      <h1><a href="<?php echo Yii::app()->request->baseUrl; ?>">Tim Burton</a></h1>
      <h2><a href="http://freaxmind.no-ip.info" target="_blank">par Freaxmind</a></h2>
    </header>

    <nav>
      <ul>
        <li class="entree_accueil first"><a href="<?php echo Yii::app()->request->baseUrl; ?>">Accueil</a></li>
        <li class="entree_billet"><?php echo CHtml::link('Billets', $this->createAbsoluteUrl('billet/')); ?></li>
        <li class="entree_film"><?php echo CHtml::link('Films', $this->createAbsoluteUrl('film/')); ?></li>
        <li class="entree_biographie"><?php echo CHtml::link('Biographie', $this->createAbsoluteUrl('biographie/')); ?></li>
        <li class="entree_contact"><?php echo CHtml::link('Contact', $this->createAbsoluteUrl('site/contact')); ?></li>
      </ul>
    </nav>

    <div id="page">

<section id="content">
<?php echo $content; ?>
</section>

<aside>
<?php echo $this->renderPartial('../billet/_last'); ?>
<br />
<?php echo $this->renderPartial('../layouts/_addthis'); ?>
</aside>

      <div class="clear"></div>
    </div>

    <footer class="clear">
      <p class="align_center">
        Tous droits réservés &copy;2011 <a href="<?php echo Yii::app()->request->baseUrl; ?>">Tim Burton</a>.
        <br />
        Réalisé par <a href="http://freaxmind.no-ip.info" target="_blank">Freaxmind</a>.
      </p>
    </footer>
  </body>
</html>