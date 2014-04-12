<?php
$this->breadcrumbs=array(
    'Types Activités'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier le Type d'Activité <?php echo $model->NOTYPACT; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
