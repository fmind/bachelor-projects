<?php
  $form=$this->beginWidget('CActiveForm', array(
    'id'=>'comment-form',
    'action' => CHtml::normalizeUrl(array('billet/comment')),
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true
    )
  ));
?>

	<?php echo $form->errorSummary($comment); ?>

    <?php echo $form->hiddenField($comment, 'billet_id'); ?>

	<div class="row">
		<?php echo $form->labelEx($comment,'pseudo'); ?>
		<?php echo $form->textField($comment,'pseudo'); ?>
		<?php echo $form->error($comment,'pseudo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($comment,'email'); ?>
		<?php echo $form->textField($comment,'email'); ?>
		<?php echo $form->error($comment,'email'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($comment,'url'); ?>
		<?php echo $form->textField($comment,'url'); ?>
		<?php echo $form->error($comment,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->textArea($comment,'contenu',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($comment,'contenu'); ?>
	</div>

    <div class="clear"></div>

	<div class="row buttons align_center">
		<?php echo CHtml::submitButton('Envoyer'); ?>
	</div>

<?php $this->endWidget(); ?>