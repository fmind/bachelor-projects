<?php
$this->breadcrumbs=array(
    'Paiements'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier le Paiement <?php echo $model->NOPAIE; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
