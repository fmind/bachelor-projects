<?php
$this->breadcrumbs=array(
    'Réservations'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier la Réservation <?php echo $model->NORES; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
