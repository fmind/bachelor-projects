<?php
$this->breadcrumbs=array(
    'Clients'=>array('index'),
    'Modifier',
);
?>

<h1>Modifier le Client <?php echo $model->NOCLIENT; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
