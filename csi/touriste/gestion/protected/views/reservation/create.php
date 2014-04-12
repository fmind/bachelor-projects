<?php
$this->breadcrumbs=array(
    'Réservations'=>array('index'),
    'Créer',
);
?>

<h1>Créer une Réservation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
