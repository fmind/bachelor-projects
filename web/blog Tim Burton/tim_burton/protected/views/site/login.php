<?php $this->pageTitle=Yii::app()->name . ' - Connexion'; ?>

<?php
$this->breadcrumbs=array(
	'Connexion',
);
?>

<h1>Connexion</h1>

<p>Connecter vous pour accéder à l'interface d'administration</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Les champs avec <span class="required">*</span> sont obligatoires.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Se connecter'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<script>
  $('#LoginForm_username').focus();
</script>