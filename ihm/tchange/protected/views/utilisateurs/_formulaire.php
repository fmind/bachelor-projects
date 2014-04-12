<? if (!isset($model)) $model = new InscriptionForm('inscription'); ?>

<? $form=$this->beginWidget('CActiveForm', array(
	'id'=>'utilisateurs-inscription-form',
    'action' => ($model->scenario == 'profil') ? '/utilisateurs/profil' : '/utilisateurs/inscription',
    'enableAjaxValidation' => true,
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true
    ),
)); ?>

    <?= $form->hiddenField($model, 'profil') ?>

	<div class="row">
		<?= $form->labelEx($model,'nom'); ?>
		<?= $form->textField($model,'nom'); ?>
		<?= $form->error($model,'nom'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'prenom'); ?>
		<?= $form->textField($model,'prenom'); ?>
		<?= $form->error($model,'prenom'); ?>
	</div>

	<div class="row">
		<?= $form->label($model,'login'); ?>
		<?= $form->textField($model,'login'); ?>
		<?= $form->error($model,'login'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'email'); ?>
		<?= $form->textField($model,'email'); ?>
		<?= $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model,'mot_de_passe'); ?>
		<?= $form->passwordField($model,'mot_de_passe'); ?>
		<?= $form->error($model,'mot_de_passe'); ?>
	</div>

    <div class="row">
		<?= $form->labelEx($model,'mot_de_passe_confirmation'); ?>
		<?= $form->passwordField($model,'mot_de_passe_confirmation'); ?>
		<?= $form->error($model,'mot_de_passe_confirmation'); ?>
	</div>

	<p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

	<div class="row-buttons">
		<?= CHtml::submitButton(($model->scenario == 'profil') ? "Enregistrer" : "S'inscrire"); ?>
	</div>

<? $this->endWidget(); ?>