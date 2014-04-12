<?php
$this->breadcrumbs=array(
    'Prestataires'=>array('index'),
    'Créer',
);
?>

<h1>Créer un Prestataire</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
