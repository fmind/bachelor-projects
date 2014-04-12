<?php
$this->breadcrumbs=array(
    'Hébergements'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier l'Hébergement <?php echo $model->NOHEBERG; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
