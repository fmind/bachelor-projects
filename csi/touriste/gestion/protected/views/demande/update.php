<?php
$this->breadcrumbs=array(
    'Demandes'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier la Demande <?php echo $model->NDEM; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
