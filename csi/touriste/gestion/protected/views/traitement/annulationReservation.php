<?php
$this->breadcrumbs=array(
    'Traitements'=>array('/traitement/'),
    'Annulation de réservation',
);
?>

<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div style="font-size: 15px; margin: 40px 0px; text-align: center; color: green;">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>

<?php else: ?>

<div class="span-10 border align_center">
    <h3>Annuler une demande en attente</h3>

    <?php $form_dem = $this->beginWidget('CActiveForm', array(
        'id'=>'annulation-demande-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <div class="row">
        <?php echo $form_dem->labelEx($demande,'NDEM'); ?>
        <?php echo $form_dem->dropDownList($demande, 'NDEM', CHtml::listData(Demande::model()->findAll("ETATDEM IN ('en attente', 'renvoie proposition')"), 'NDEM', 'NDEM')); ?>
        <?php echo $form_dem->error($demande,'NDEM'); ?>
    </div>

    <br />

    <div class="row buttons">
        <?php echo CHtml::submitButton('Annuler cette demande'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>

<div class="span-13 last align_center" >
    <h3>Annuler une réservation</h3>

    <?php $form_res = $this->beginWidget('CActiveForm', array(
        'id'=>'annulation-reservation-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <div class="row">
        <?php echo $form_res->labelEx($reservation,'NORES'); ?>
        <?php echo $form_res->dropDownList($reservation, 'NORES', CHtml::listData(Reservation::model()->findAll("ETATRES IN ('en attente arrhes', 'effective', 'complete')"), 'NORES', 'NORES')); ?>
        <?php echo $form_res->error($reservation,'NORES'); ?>
    </div>

    <br />

    <div class="row">
        <label for="PREVU">Prévu dans le contrat (assurance)</label>
        <input type="checkbox" id="PREVU" name="PREVU" />
    </div>

    <br />

    <div class="row buttons">
        <?php echo CHtml::submitButton('Annuler cette réservation'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>

<?php endif; ?>

