<?php
$this->breadcrumbs=array(
    'Saisons'=>array('index'),
    'Hébergements',
);

$hebergs_no = array();
$prix = array();
foreach ($model->hebergements as $heberg) {
    $hebergs_no[] = $heberg->NOHEBERG;
    $pour = APour::model()->find('NOSAISON=:nosaison AND NOHEBERG=:noheberg', array('nosaison' => $model->NOSAISON , 'noheberg' => $heberg->NOHEBERG));
    $prix[$heberg->NOHEBERG] = $pour->PRIX;
}
?>

<h1>Hébergements pour la saison <?php echo $model->NOSAISON; ?></h1>

<div class="form associations">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'saison-hebergements-form',
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo CHtml::hiddenField('changed', true); ?>

    <?php foreach (Hebergement::model()->findAll() as $hebergement): ?>
        <?php echo CHtml::checkBox('Hebergements[]', in_array($hebergement->NOHEBERG, $hebergs_no), array('value' => $hebergement->NOHEBERG, 'id' => 'check_'.$hebergement->NOHEBERG)); ?>
        <?php echo CHtml::label($hebergement->NOHEBERG, false); ?>
        <div class="prix">
            <?php echo CHtml::label('Prix', false); ?>
            <?php echo CHtml::textField('Prix['.$hebergement->NOHEBERG.']', (isset($prix[$hebergement->NOHEBERG]) ? $prix[$hebergement->NOHEBERG] : '0')); ?>
        </div>
        <br />
    <? endforeach; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Sauvegarder'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<style>
.prix {
    margin: 5px 50px;
}
.prix label {
    float: left;
    margin: 5px;
}
</style>
