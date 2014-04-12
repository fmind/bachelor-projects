<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'demande-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Les champs avec une <span class="required">*</span> sont obligatoires.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'NOCLIENT'); ?>
        <?php echo $form->dropDownList($model, 'NOCLIENT', CHtml::listData(Client::model()->findAll(), 'NOCLIENT', 'NOM')); ?>
        <?php echo $form->error($model,'NOCLIENT'); ?>
        <?php if ($model->scenario == "traitement"): ?>
        <p>
            Nouveau client ? <a href="/client/create?from=/traitement/demandeDisponibilite/">Créer son compte</a> associé au site avant de continuer.
        </p>
        <?php endif; ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'NOSTAT'); ?>
        <?php echo $form->dropDownList($model, 'NOSTAT', CHtml::listData(Station::model()->findAll(), 'NOSTAT', 'NOMSTAT')); ?>
        <?php echo $form->error($model,'NOSTAT'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'NOTYPEPREST'); ?>
        <?php echo $form->dropDownList($model, 'NOTYPEPREST', CHtml::listData(TypePrest::model()->findAll(), 'NOTYPP', 'NOMTYP')); ?>
        <?php echo $form->error($model,'NOTYPEPREST'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'NOTYPH'); ?>
        <?php echo $form->dropDownList($model, 'NOTYPH', CHtml::listData(TypeHeberg::model()->findAll(), 'NOTYPH', 'NOMTYPH')); ?>
        <?php echo $form->error($model,'NOTYPH'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'DATEDEBUTRES'); ?>
        <?php echo $form->textField($model,'DATEDEBUTRES'); ?>
        <?php echo $form->error($model,'DATEDEBUTRES'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'DATEFINRES'); ?>
        <?php echo $form->textField($model,'DATEFINRES'); ?>
        <?php echo $form->error($model,'DATEFINRES'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'NBPERSRES'); ?>
        <?php echo $form->textField($model,'NBPERSRES'); ?>
        <?php echo $form->error($model,'NBPERSRES'); ?>
    </div>

    <?php if ($model->scenario != "traitement"): ?>

    <div class="row">
        <?php echo $form->labelEx($model,'ETATDEM'); ?>
        <?php echo $form->dropDownList($model,'ETATDEM', array('en attente' => 'en attente', 'validé' => 'validé','annulé' => 'annulé', 'renvoie proposition' => 'renvoie proposition')); ?>
        <?php echo $form->error($model,'ETATDEM'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'CODEATTENTE'); ?>
        <?php echo $form->textField($model,'CODEATTENTE'); ?>
        <?php echo $form->error($model,'CODEATTENTE'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'DATDEM'); ?>
        <?php echo $form->textField($model,'DATDEM'); ?>
        <?php echo $form->error($model,'DATDEM'); ?>
    </div>

    <?php endif; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Modifier'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
