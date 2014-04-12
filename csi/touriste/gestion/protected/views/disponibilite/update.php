<?php
$this->breadcrumbs=array(
    'Disponibilités'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier la Disponibilité <?php echo $model->NODISP; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
