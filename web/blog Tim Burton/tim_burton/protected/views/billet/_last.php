<div class="boxed">
  <hgroup>
    <h2>Derniers billets</h2>
  </hgroup>

  <div class="content">
    <ul class="menu classic_font">
    <?php foreach (Billet::model()->findAll(array('limit' => 5, 'order' => 'create_time DESC')) as $billet): ?>
        <li><a href="<?php echo $billet->getURL(); ?>"><?php echo CHtml::encode($billet->titre); ?></a></li>
    <?php endforeach; ?>
    </ul>
  </div>
</div>