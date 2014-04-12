<?php
$this->breadcrumbs=array(
    'Services'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier le Service <?php echo $model->NOSERV; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
