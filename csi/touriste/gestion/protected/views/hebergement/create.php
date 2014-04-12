<?php
$this->breadcrumbs=array(
    'Hébergements'=>array('index'),
    'Créer',
);
?>

<h1>Créer un Hébergement</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
