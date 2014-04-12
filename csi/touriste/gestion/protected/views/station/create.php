<?php
$this->breadcrumbs=array(
    'Stations'=>array('index'),
    'Créer',
);
?>

<h1>Créer une Station</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
