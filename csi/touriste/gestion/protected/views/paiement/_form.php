<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'paiement-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php
        if ($model->scenario == 'traitement'):
            if (!isset($reception)):
                $reservations = CHtml::listData(Reservation::model()->findAll("ETATRES = 'en attente arrhes'"), 'NORES', 'NORES');
            else:
                $reservations = CHtml::listData(Reservation::model()->findAll("ETATRES = 'effective'"), 'NORES', 'NORES');
            endif;
        else:
            $reservations = CHtml::listData(Reservation::model()->findAll(), 'NORES', 'NORES');
        endif;
    ?>

    <div class="row">
        <?php echo $form->labelEx($model,'NORES'); ?>
        <?php echo $form->dropDownList($model, 'NORES', $reservations); ?>
        <?php echo $form->error($model,'NORES'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'NOTYPPAIE'); ?>
        <?php echo $form->dropDownList($model, 'NOTYPPAIE', CHtml::listData(TypePaiement::model()->findAll(), 'NOTYPPAIE', 'LIBELLETYPPAIE')); ?>
        <?php echo $form->error($model,'NOTYPPAIE'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'MONTANTPAIE'); ?>
        <?php echo $form->textField($model,'MONTANTPAIE'); ?>
        <?php echo $form->error($model,'MONTANTPAIE'); ?>
    </div>

    <?php if ($model->scenario != 'traitement'): ?>

    <div class="row">
        <?php echo $form->labelEx($model,'LIBELLEPAIE'); ?>
        <?php echo $form->textField($model,'LIBELLEPAIE'); ?>
        <?php echo $form->error($model,'LIBELLEPAIE'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'DATEPAIE'); ?>
        <?php echo $form->textField($model,'DATEPAIE'); ?>
        <?php echo $form->error($model,'DATEPAIE'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'REMBOURSEPAIE'); ?>
        <?php echo $form->checkBox($model,'REMBOURSEPAIE'); ?>
        <?php echo $form->error($model,'REMBOURSEPAIE'); ?>
    </div>

    <? endif; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
