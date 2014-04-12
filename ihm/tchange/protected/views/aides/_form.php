<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'aides-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'libelle'); ?>
		<?php echo $form->textField($model,'libelle',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'libelle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->