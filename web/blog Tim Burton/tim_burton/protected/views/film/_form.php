<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'film-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data')
)); ?>

	<p class="note">Les champs avec <span class="required">*</span> sont obligatoires.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'titre'); ?>
		<?php echo $form->textField($model,'titre',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'titre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_sortie'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                  'name'=>'Film[date_sortie]',
                  'model'=>$model,
                  'value'=>$model->date_sortie,
                  'language'=>'fr',
                  'options'=>array(
                      'showAnim'=>'fold',
                  )
              ));
        ?>
		<?php echo $form->error($model,'date_sortie'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'genres'); ?>
		<?php echo $form->textField($model,'genres',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'genres'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'acteurs_principaux'); ?>
		<?php echo $form->textField($model,'acteurs_principaux',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'acteurs_principaux'); ?>
	</div>

    <div class="row">
      <?php echo $form->labelEx($model,'image'); ?>
      <div class="right">
        <?php echo CHtml::image(
                Yii::app()->baseUrl.'/images/films/'.$model->id.'.jpg',
                'Affiche du film '.$model->titre,
                array('width' => '150', 'height' => '200'));
        ?>
      </div>
      <?php echo CHtml::activeFileField($model, 'image'); ?>
      <?php echo $form->error($model,'image'); ?>
    </div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'synopsis'); ?>
		<?php echo $form->textArea($model,'synopsis',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'synopsis'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->