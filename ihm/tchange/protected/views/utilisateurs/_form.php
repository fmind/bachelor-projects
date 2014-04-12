<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'utilisateurs-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nom'); ?>
		<?php echo $form->textField($model,'nom',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prenom'); ?>
		<?php echo $form->textField($model,'prenom',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'prenom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mot_de_passe'); ?>
		<?php echo $form->passwordField($model,'mot_de_passe',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'mot_de_passe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profil'); ?>
		<?php echo $form->textField($model,'profil'); ?>
		<?php echo $form->error($model,'profil'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->