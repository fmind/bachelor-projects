<?php
$this->breadcrumbs=array(
    'Disponibilités'=>array('index'),
    'Créer',
);
?>

<h1>Créer une Disponibilité</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
