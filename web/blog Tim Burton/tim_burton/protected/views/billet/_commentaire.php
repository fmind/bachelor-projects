<div class="commentaire">
  <h4>
    <div class="right">
      <span><?php echo Yii::app()->dateFormatter->formatDateTime($comment->create_time); ?></span>
    </div>

    <span><?php echo CHtml::encode(ucfirst($comment->pseudo)); ?></span>
    <?php if ($comment->url): ?>
    <br />
    Site : <a href="<?php echo CHtml::encode($comment->url); ?>" target="_blank"><?php echo CHtml::encode($comment->url); ?></a>
    <?php endif; ?>
  </h4>

  <br />

  <p class="classic_font surbrillance">
    <?php echo nl2br(CHtml::encode($comment->contenu)); ?>
  </p>
  <br />
</div>