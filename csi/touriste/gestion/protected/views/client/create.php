<?php
$this->breadcrumbs=array(
    'Clients'=>array('index'),
    'Créer',
);
?>

<h1>Créer un Client</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
