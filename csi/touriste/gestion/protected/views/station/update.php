<?php
$this->breadcrumbs=array(
    'Stations'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier la station <?php echo $model->NOSTAT; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
