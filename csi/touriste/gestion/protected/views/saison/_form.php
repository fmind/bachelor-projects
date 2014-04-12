<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'saison-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'DATEDEBS'); ?>
        <?php echo $form->textField($model,'DATEDEBS'); ?>
        <?php echo $form->error($model,'DATEDEBS'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'DATEFINS'); ?>
        <?php echo $form->textField($model,'DATEFINS'); ?>
        <?php echo $form->error($model,'DATEFINS'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
