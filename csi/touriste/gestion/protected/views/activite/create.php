<?php
$this->breadcrumbs=array(
    'Activités'=>array('index'),
    'Créer',
);
?>

<h1>Créer une Activité</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
