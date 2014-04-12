<?php
$this->breadcrumbs=array(
    'Stations'=>array('index'),
    'Activités',
);

$activites_no = array();
foreach ($model->activites as $act)
    $activites_no[] = $act->NOACT;
?>

<h1>Activités de la station <?php echo $model->NOSTAT; ?></h1>

<div class="form associations">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'station-activites-form',
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo CHtml::hiddenField('changed', true); ?>

    <?php foreach (Activite::model()->findAll() as $activite): ?>
        <?php echo CHtml::checkBox('Activites[]', in_array($activite->NOACT, $activites_no), array('value' => $activite->NOACT, 'id' => 'check_'.$activite->NOACT)); ?>
        <?php echo CHtml::label($activite->NOMACT, false); ?>
        <br />
    <? endforeach; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Sauvegarder'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
