<?php
$this->breadcrumbs=array(
    'Prestataires'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier le Prestataire <?php echo $model->NOPREST; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
