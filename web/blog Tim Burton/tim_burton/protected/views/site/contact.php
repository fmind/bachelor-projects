<?php
  $this->pageTitle="Contactez nous";
  $this->activeEntry="contact";
?>

<h1 class="align_center">Contactez nous</h1>

<br />

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="successMessage align_center">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p class="classic_font align_center">
  Pour une question ou une remarque, merci de nous contacter !
</p>

<br />

<div class="form classic_font">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<div class="catchpa">
          <?php $this->widget('CCaptcha'); ?>
          <?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

    <div class="clear"></div>
  
	<div class="row buttons align_center">
		<?php echo CHtml::submitButton('Envoyer'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>