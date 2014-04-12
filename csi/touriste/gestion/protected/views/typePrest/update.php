<?php
$this->breadcrumbs=array(
    'Types Prestation'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier le Type de Prestation <?php echo $model->NOTYPP; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
