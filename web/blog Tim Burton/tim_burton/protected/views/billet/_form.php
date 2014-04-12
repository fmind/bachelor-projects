<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'billet-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Les champs avec <span class="required">*</span> sont obligatoires.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'titre'); ?>
		<?php echo $form->textField($model,'titre',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'titre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contenu'); ?>
		<?php $this->widget('application.extensions.tinymce.ETinyMce',array(
                'name'=>'Billet[contenu]',
                'editorTemplate' => 'full',
                'value' => $model->contenu
              )
            ); ?>
        <br />
        <?php echo $form->error($model,'contenu'); ?>
	</div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->