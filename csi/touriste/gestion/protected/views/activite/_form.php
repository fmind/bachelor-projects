<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'activite-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'NOTYPACT'); ?>
        <?php echo $form->dropDownList($model, 'NOTYPACT', CHtml::listData(TypeActivite::model()->findAll(), 'NOTYPACT', 'NOMTYPACT')); ?>
        <?php echo $form->error($model,'NOTYPACT'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'NOMACT'); ?>
        <?php echo $form->textField($model,'NOMACT'); ?>
        <?php echo $form->error($model,'NOMACT'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'INTERIEUR'); ?>
        <?php echo $form->checkBox($model,'INTERIEUR'); ?>
        <?php echo $form->error($model,'INTERIEUR'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'ENFANTACT'); ?>
        <?php echo $form->checkBox($model,'ENFANTACT'); ?>
        <?php echo $form->error($model,'ENFANTACT'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
