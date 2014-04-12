<?php
$this->breadcrumbs=array(
    'Types Hébergement'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier le Type d'Hébergement <?php echo $model->NOTYPH; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
