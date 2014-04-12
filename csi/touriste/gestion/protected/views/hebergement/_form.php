<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'hebergement-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php if ($model->scenario == "traitement"): ?>
    <div class="align_center right" style="margin: 50px 75px 0px 0px;">
        <h3>Disponibilités</h3>
        <?php foreach (Disponibilite::model()->findAll() as $dispo): ?>
            <?php echo CHtml::checkBox('Disponibilites[]', false, array('value' => $dispo->NODISP, 'id' => 'check_'.$dispo->NODISP, "class" => "left")); ?>
            <?php echo CHtml::label($dispo->DATEDEBDISP.' - '.$dispo->DATEFINDISP, false, array('style'=> 'display: inline; padding: 10px 15px;')); ?>
            <br /><br />
        <? endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="row">
        <?php echo $form->labelEx($model,'NOPREST'); ?>
        <?php echo $form->dropDownList($model, 'NOPREST', CHtml::listData(Prestataire::model()->findAll(), 'NOPREST', 'NOMPREST')); ?>
        <?php echo $form->error($model,'NOPREST'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'NOTYPH'); ?>
        <?php echo $form->dropDownList($model, 'NOTYPH', CHtml::listData(TypeHeberg::model()->findAll(), 'NOTYPH', 'NOMTYPH')); ?>
        <?php echo $form->error($model,'NOTYPH'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'ADRESSE'); ?>
        <?php echo $form->textArea($model,'ADRESSE',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'ADRESSE'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'QUALITE'); ?>
        <?php echo $form->dropDownList($model,'QUALITE', array('neuf' => 'neuf', 'récent' => 'récent', 'ancien' => 'ancien')); ?>
        <?php echo $form->error($model,'QUALITE'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'SURFACE'); ?>
        <?php echo $form->textField($model,'SURFACE'); ?>
        <?php echo $form->error($model,'SURFACE'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'NBLITADULT'); ?>
        <?php echo $form->textField($model,'NBLITADULT'); ?>
        <?php echo $form->error($model,'NBLITADULT'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'NBLITENFANT'); ?>
        <?php echo $form->textField($model,'NBLITENFANT'); ?>
        <?php echo $form->error($model,'NBLITENFANT'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'WIFI'); ?>
        <?php echo $form->checkBox($model,'WIFI'); ?>
        <?php echo $form->error($model,'WIFI'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'RESTAURATION'); ?>
        <?php echo $form->checkBox($model,'RESTAURATION'); ?>
        <?php echo $form->error($model,'RESTAURATION'); ?>
    </div>

    <?php if ($model->scenario != "traitement"): ?>
    <div class="row">
        <?php echo $form->label($model,'GESTIONAGENCE'); ?>
        <?php echo $form->checkBox($model,'GESTIONAGENCE'); ?>
        <?php echo $form->error($model,'GESTIONAGENCE'); ?>
    </div>
    <?php endif; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
