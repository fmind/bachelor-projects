<?php
$this->breadcrumbs=array(
    'Hébergements'=>array('index'),
    'Disponibilités',
);

$dispos_no = array();
foreach ($model->disponibilites as $disp)
    $dispos_no[] = $disp->NODISP;
?>

<h1>Disponibilités pour l'hébergement <?php echo $model->NOPREST; ?></h1>

<div class="form associations">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'hebergement-disponibilites-form',
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo CHtml::hiddenField('changed', true); ?>

    <?php foreach (Disponibilite::model()->findAll() as $dispo): ?>
        <?php echo CHtml::checkBox('Disponibilites[]', in_array($dispo->NODISP, $dispos_no), array('value' => $dispo->NODISP, 'id' => 'check_'.$dispo->NODISP)); ?>
        <?php echo CHtml::label($dispo->DATEDEBDISP.' - '.$dispo->DATEFINDISP, false); ?>
        <br />
    <? endforeach; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Sauvegarder'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
