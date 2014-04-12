<?php
$this->breadcrumbs=array(
    'Activités'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier l'Activité <?php echo $model->NOACT; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
