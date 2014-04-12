<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'disponibilite-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'DATEDEBDISP'); ?>
        <?php echo $form->textField($model,'DATEDEBDISP'); ?>
        <?php echo $form->error($model,'DATEDEBDISP'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'DATEFINDISP'); ?>
        <?php echo $form->textField($model,'DATEFINDISP'); ?>
        <?php echo $form->error($model,'DATEFINDISP'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
