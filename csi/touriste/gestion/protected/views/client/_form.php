<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'client-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'NOM'); ?>
        <?php echo $form->textField($model,'NOM'); ?>
        <?php echo $form->error($model,'NOM'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'PRENOM'); ?>
        <?php echo $form->textField($model,'PRENOM'); ?>
        <?php echo $form->error($model,'PRENOM'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'DATENAISS'); ?>
        <?php echo $form->textField($model,'DATENAISS'); ?>
        <?php echo $form->error($model,'DATENAISS'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'SEXE'); ?>
        <?php echo $form->dropDownList($model,'SEXE', array('H' => 'Homme', 'F' => 'Femme', 'I' => 'Indéterminé')); ?>
        <?php echo $form->error($model,'SEXE'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'SITMARITAL'); ?>
        <?php echo $form->dropDownList($model,'SITMARITAL', array('célibataire' => 'célibataire', 'marié' => 'marié', 'divorcé' => 'divorcé')); ?>
        <?php echo $form->error($model,'SITMARITAL'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'TELEPHONECLIENT'); ?>
        <?php echo $form->textField($model,'TELEPHONECLIENT'); ?>
        <?php echo $form->error($model,'TELEPHONECLIENT'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'EMAILCLIENT'); ?>
        <?php echo $form->textField($model,'EMAILCLIENT'); ?>
        <?php echo $form->error($model,'EMAILCLIENT'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'ADRESSECLIENT'); ?>
        <?php echo $form->textArea($model,'ADRESSECLIENT',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'ADRESSECLIENT'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
