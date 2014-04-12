<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'service-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'NOMSERVICE'); ?>
        <?php echo $form->textField($model,'NOMSERVICE'); ?>
        <?php echo $form->error($model,'NOMSERVICE'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'COMPRIS'); ?>
        <?php echo $form->checkBox($model,'COMPRIS'); ?>
        <?php echo $form->error($model,'COMPRIS'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
