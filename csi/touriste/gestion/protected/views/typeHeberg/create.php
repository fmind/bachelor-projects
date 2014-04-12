<?php
$this->breadcrumbs=array(
    'Type Hébergements'=>array('index'),
    'Créer',
);
?>

<h1>Créer un Type d'Hébergement</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
