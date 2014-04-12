<div id="commentaire_<?php echo $model->id ?>">
  <span class="right">
    <?php
      echo CHtml::ajaxLink(
              'supprimer',
              Yii::app()->createURL('billet/moderate', array('id' => $model->id)),
              array('success' => "function(data) {
                $('#commentaire_". $model->id."').fadeOut('slow', function() {
                  $(this).remove();
                  var compteur = $('#nb_commentaires');
                  compteur.text(parseInt(compteur.text()-1));
                });
              }")
      );
    ?>
  </span>

  <h3>
    De <?php echo CHtml::encode($model->pseudo); ?>
    le <?php echo Yii::app()->dateFormatter->formatDateTime($model->create_time); ?>
  </h3>
  <h4>email : <?php echo CHtml::encode($model->email); ?>, site: <?php echo CHtml::encode($model->url); ?></h4>

  <?php echo CHtml::encode($model->contenu); ?>
  <br />
</div>

<br />