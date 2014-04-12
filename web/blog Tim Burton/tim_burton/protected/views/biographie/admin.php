<?php $this->pageTitle='Modifier la biographie' ?>

<?php

$this->breadcrumbs=array(
	'Billets' => Yii::app()->createURL('biographie/admin'),
    'modifier'
);

?>

<h1>Modifier la biographie</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'biographie-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($bio); ?>

	<div class="row">
		<?php $this->widget('application.extensions.tinymce.ETinyMce',array(
                'name'=>'Biographie[contenu]',
                'editorTemplate' => 'full',
                'value' => $bio->contenu
              )
            ); ?>
        <br />
        <?php echo $form->error($bio,'contenu'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Modifier'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->