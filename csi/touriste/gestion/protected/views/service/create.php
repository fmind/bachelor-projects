<?php
$this->breadcrumbs=array(
    'Services'=>array('index'),
    'Créer',
);
?>

<h1>Créer un Service</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
