<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sous-categories-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nom'); ?>
		<?php echo $form->textField($model,'nom',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nom'); ?>
	</div>

	<div class="row">
        <?php $categories = new Categories() ?>
		<?php echo $form->labelEx($model,'categorie'); ?>
		<?php echo $form->dropDownList($model, 'categorie', CHtml::listData($categories->findAll(), 'id', 'nom')); ?>
		<?php echo $form->error($model,'categorie'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->