<?php
$this->breadcrumbs=array(
    'Types Paiements'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier le Type de Paiement <?php echo $model->NOTYPPAIE; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
