<?php 
  $this->pageTitle=$billet->titre;
  $this->activeEntry='billet';
?>

<article>
  <hgroup>
    <h3 class="right">
      Écrit le <?php echo Yii::app()->dateFormatter->formatDateTime($billet->create_time); ?>
      <br />
      Modifié le <?php echo Yii::app()->dateFormatter->formatDateTime($billet->update_time); ?>
    </h3>

    <h2><?php echo CHtml::encode($billet->titre) ?></h1>
  </hgroup>

  <div class="clear"></div>
  
  <section class="classic_font">
    <?php echo $billet->contenu ?>
  </section>

  <br /><hr /><br />

  <section id="comments">
    <?php if ($focus_comment): ?>
    <script>
      comment_focus();
    </script>
    <?php else: ?>
    <div class="boutons align_center">
      <a href="javascript:comment_add();">Ajouter votre commentaire</a>
    </div>

    <div class="form classic_font hide">
      <?php echo $this->renderPartial('_form_commentaire', array('comment'=>$comment_form)); ?>
    </div>

    <br />
    <?php endif; ?>

    <a name="#comments"></a>
    
    <div class="liste">
      <?php foreach ($billet->commentaires as $comment): ?>
        <?php echo $this->renderPartial('_commentaire', array('comment'=>$comment)); ?>
      <?php endforeach; ?>
    </div>
  </section>
</article>