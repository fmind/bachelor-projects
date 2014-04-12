<?php
$this->breadcrumbs=array(
    'Stations'=>array('index'),
    'Particularités',
);

$particularites_no = array();
foreach ($model->particularites as $part)
    $particularites_no[] = $part->NOPART;
?>

<h1>Particularités de la station <?php echo $model->NOSTAT; ?></h1>

<div class="form associations">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'station-particularites-form',
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo CHtml::hiddenField('changed', true); ?>

    <?php foreach (Particularite::model()->findAll() as $particularite): ?>
        <?php echo CHtml::checkBox('Particularites[]', in_array($particularite->NOPART, $particularites_no), array('value' => $particularite->NOPART, 'id' => 'check_'.$particularite->NOPART)); ?>
        <?php echo CHtml::label($particularite->NOMPART, false); ?>
        <br />
    <? endforeach; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Sauvegarder'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
