<? $form=$this->beginWidget('CActiveForm', array(
    'id'=>'message-form',
    'action' => ($model->scenario == 'question') ? '/messages/question' : '/messages/repondre',
)); ?>

    <?= $form->hiddenField($model, 'source') ?>
    <?= $form->hiddenField($model, 'destinataire') ?>
    <?= $form->hiddenField($model, 'bien') ?>

    <div class="row">
        <?php echo $form->textArea($model, 'message', array('rows' => 6, 'cols' => 50, 'onblur' => 'setWaterMark(this, \'Saisissez ici votre question\');', 'onfocus' => 'clearWaterMark(this, \'Saisissez ici votre question\');')); ?>
        <?php echo $form->error($model, 'message'); ?>
    </div>

    <div class="row-buttons">
        <?= CHtml::submitButton("Envoyer"); ?>
    </div>

<? $this->endWidget(); ?>