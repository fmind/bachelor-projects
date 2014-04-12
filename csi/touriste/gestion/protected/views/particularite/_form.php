<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'particularite-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'NOMPART'); ?>
        <?php echo $form->textField($model,'NOMPART'); ?>
        <?php echo $form->error($model,'NOMPART'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'ADRESSEPART'); ?>
        <?php echo $form->textArea($model,'ADRESSEPART',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'ADRESSEPART'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'DESCRIPTIONPART'); ?>
        <?php echo $form->textArea($model,'DESCRIPTIONPART',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'DESCRIPTIONPART'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'HANDI_ACCESSIBLE'); ?>
        <?php echo $form->checkBox($model,'HANDI_ACCESSIBLE'); ?>
        <?php echo $form->error($model,'HANDI_ACCESSIBLE'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
