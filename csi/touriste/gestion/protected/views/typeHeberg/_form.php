<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'type-heberg-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'NOMTYPH'); ?>
        <?php echo $form->textField($model,'NOMTYPH'); ?>
        <?php echo $form->error($model,'NOMTYPH'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
