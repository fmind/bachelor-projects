<?php
$this->breadcrumbs=array(
    'Prestataires'=>array('index'),
    'Services',
);

$services_no = array();
foreach ($model->services as $serv)
    $services_no[] = $serv->NOSERV;
?>

<h1>Services du prestataire <?php echo $model->NOPREST; ?></h1>

<div class="form associations">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'prestataire-services-form',
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo CHtml::hiddenField('changed', true); ?>

    <?php foreach (Service::model()->findAll() as $service): ?>
        <?php echo CHtml::checkBox('Services[]', in_array($service->NOSERV, $services_no), array('value' => $service->NOSERV, 'id' => 'check_'.$service->NOSERV)); ?>
        <?php echo CHtml::label($service->NOMSERVICE, false); ?>
        <br />
    <? endforeach; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Sauvegarder'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
