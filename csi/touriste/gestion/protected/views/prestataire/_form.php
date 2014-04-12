<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'prestataire-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'NOSTAT'); ?>
        <?php echo $form->dropDownList($model, 'NOSTAT', CHtml::listData(Station::model()->findAll(), 'NOSTAT', 'NOMSTAT')); ?>
        <?php echo $form->error($model,'NOSTAT'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'NOTYPP'); ?>
        <?php echo $form->dropDownList($model, 'NOTYPP', CHtml::listData(TypePrest::model()->findAll(), 'NOTYPP', 'NOMTYP')); ?>
        <?php echo $form->error($model,'NOTYPP'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'NOMPREST'); ?>
        <?php echo $form->textField($model,'NOMPREST',array('size'=>30,'maxlength'=>30)); ?>
        <?php echo $form->error($model,'NOMPREST'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'TELEPHONEPREST'); ?>
        <?php echo $form->textField($model,'TELEPHONEPREST'); ?>
        <?php echo $form->error($model,'TELEPHONEPREST'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'EMAILPREST'); ?>
        <?php echo $form->textField($model,'EMAILPREST'); ?>
        <?php echo $form->error($model,'EMAILPREST'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
