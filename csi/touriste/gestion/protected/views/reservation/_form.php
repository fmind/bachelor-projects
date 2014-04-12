<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'reservation-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php if ($model->scenario == "traitement"): ?>
    <div class="row">
        <?php echo $form->labelEx($model,'NDEM'); ?>
        <?php echo $form->dropDownList($model, 'NDEM', CHtml::listData(Demande::model()->findAll("ETATDEM NOT IN ('validé', 'refusé', 'en attente')"), 'NDEM', 'NDEM')); ?>
        <?php echo $form->error($model,'NDEM'); ?>
    </div>
    <?php else: ?>
    <div class="row">
        <?php echo $form->labelEx($model,'NDEM'); ?>
        <?php echo $form->dropDownList($model, 'NDEM', CHtml::listData(Demande::model()->findAll(), 'NDEM', 'NDEM')); ?>
        <?php echo $form->error($model,'NDEM'); ?>
    </div>
    <?php endif; ?>

    <?php if ($model->scenario == "traitement"): ?>
    <div class="row">
        <?php echo $form->labelEx($model,'NOHEBERG'); ?>
        <?php echo $form->dropDownList($model, 'NOHEBERG', CHtml::listData(Hebergement::model()->findAll("GESTIONAGENCE = 1"), 'NOHEBERG', 'NOHEBERG')); ?>
        <?php echo $form->error($model,'NOHEBERG'); ?>
    </div>
    <?php else: ?>
    <div class="row">
        <?php echo $form->labelEx($model,'NOHEBERG'); ?>
        <?php echo $form->dropDownList($model, 'NOHEBERG', CHtml::listData(Hebergement::model()->findAll(), 'NOHEBERG', 'NOHEBERG')); ?>
        <?php echo $form->error($model,'NOHEBERG'); ?>
    </div>
    <?php endif; ?>

    <div class="row">
        <?php echo $form->label($model,'ASSURANCE'); ?>
        <?php echo $form->checkBox($model,'ASSURANCE'); ?>
        <?php echo $form->error($model,'ASSURANCE'); ?>
    </div>

    <?php if ($model->scenario != "traitement"): ?>

    <div class="row">
        <?php echo $form->labelEx($model,'DATERES'); ?>
        <?php echo $form->textField($model,'DATERES'); ?>
        <?php echo $form->error($model,'DATERES'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'MONTANTRES'); ?>
        <?php echo $form->textField($model,'MONTANTRES'); ?>
        <?php echo $form->error($model,'MONTANTRES'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'DATANNUL'); ?>
        <?php echo $form->textField($model,'DATANNUL'); ?>
        <?php echo $form->error($model,'DATANNUL'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'ETATRES'); ?>
        <?php echo $form->dropDownList($model,'ETATRES', array('en attente arrhes' => 'en attente arrhes', 'effective' => 'effective', 'annule' => 'annule', 'refusé' => 'refusé', 'complete' => 'complete')); ?>
        <?php echo $form->error($model,'ETATRES'); ?>
    </div>

    <?php endif; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
