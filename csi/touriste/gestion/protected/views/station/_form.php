<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'station-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'NOMSTAT'); ?>
        <?php echo $form->textField($model,'NOMSTAT'); ?>
        <?php echo $form->error($model,'NOMSTAT'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'ADRESSESTAT'); ?>
        <?php echo $form->textField($model,'ADRESSESTAT'); ?>
        <?php echo $form->error($model,'ADRESSESTAT'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'TELEPHONESTAT'); ?>
        <?php echo $form->textField($model,'TELEPHONESTAT'); ?>
        <?php echo $form->error($model,'TELEPHONESTAT'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'EMAILSTAT'); ?>
        <?php echo $form->textField($model,'EMAILSTAT'); ?>
        <?php echo $form->error($model,'EMAILSTAT'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
