<?php
$this->breadcrumbs=array(
    'Traitements'=>array('/traitement/'),
    'Reprise de Gestion',
);
?>

<h1>Reprise de Gestion d'un Hébergement</h1>

<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div style="font-size: 15px; margin: 40px 0px; text-align: center; color: green;">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>

<?php else: ?>

<div class="form align_center">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'reprise-gestion-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'NOHEBERG'); ?>
        <?php echo $form->dropDownList($model, 'NOHEBERG', CHtml::listData(Hebergement::model()->findAll("GESTIONAGENCE = 1"), 'NOHEBERG', 'NOHEBERG')); ?>
        <?php echo $form->error($model,'NOHEBERG'); ?>
    </div>

    <br />

    <div class="row buttons">
        <?php echo CHtml::submitButton('Reprise de gestion par le prestataire'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>

<?php endif; ?>
