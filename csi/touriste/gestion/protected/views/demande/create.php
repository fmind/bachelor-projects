<?php
$this->breadcrumbs=array(
    'Demandes'=>array('index'),
    'Créer',
);
?>

<h1>Créer une Demande</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
